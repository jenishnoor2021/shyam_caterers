<?php

use App\Models\Functio;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu Preparation</title>
    <link href="{{ asset('front_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .category {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Menu Preparation for: {{ $booking->customer_name }} - {{ $booking->event }}</h2>

        <!-- Function Tabs -->
        <ul class="nav nav-tabs mt-4" id="functionTabs">
            @foreach ($functions as $index => $func)
            @php
            $getDetail = Functio::find($func['fun_id']);
            $name = $getDetail ? $getDetail->function_type : 'Unknown';
            @endphp
            <li class="nav-item">
                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#func_{{ $index }}">{{ strtoupper($name) }}</a>
            </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('menu.store') }}" target="_blank">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <div class="tab-content mt-4">
                @foreach ($functions as $index => $func)
                @php
                $funcId = $func['fun_id'];
                $alreadySelected = $selectedItems[$funcId] ?? [];
                @endphp
                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="func_{{ $index }}">
                    <div class="row">
                        <!-- Categories -->
                        <div class="col-md-2 border-end">
                            <h6>Categories</h6>
                            <ul class="list-group">
                                <li class="list-group-item category active" data-tab="{{ $index }}" data-cat="all">
                                    All Items
                                </li>
                                @foreach ($categories as $cat)
                                <li class="list-group-item category" data-tab="{{ $index }}" data-cat="{{ $cat->id }}">
                                    {{ $cat->category_name }}
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Items -->
                        <div class="col-md-6">
                            <div class="row" id="items_{{ $index }}">
                                @foreach ($items as $item)
                                @php
                                $isSelected = in_array($item->item_name, $alreadySelected);
                                @endphp
                                <div class="col-md-4 mb-3 menu-item tab_{{ $index }}" data-cat="{{ $item->categories_id }}">
                                    <div class="card">
                                        <img src="{{ $item->file }}" class="card-img-top" style="height: 100px; object-fit: cover;">
                                        <div class="card-body">
                                            <h6>{{ $item->item_name }}</h6>
                                            @unless ($isSelected)
                                            <button type="button"
                                                class="btn btn-sm btn-primary select-item"
                                                data-tab="{{ $index }}"
                                                data-name="{{ $item->item_name }}"
                                                data-function-id="{{ $funcId }}"
                                                style="{{ $isSelected ? 'display: none;' : '' }}">
                                                Add
                                            </button>
                                            @endunless
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Selected Items -->
                        <div class="col-md-4">
                            <h6>Selected</h6>
                            <ul class="list-group" id="selected_{{ $index }}">
                                @foreach ($alreadySelected as $itemName)
                                <li class="list-group-item d-flex justify-content-between align-items-center" data-name="{{ $itemName }}">
                                    {{ $itemName }}
                                    <input type="hidden" name="selected_items[{{ $funcId }}][]" value="{{ $itemName }}">
                                    <button type="button"
                                        class="btn btn-sm btn-danger remove-item"
                                        data-tab="{{ $index }}"
                                        data-function-id="{{ $funcId }}"
                                        data-name="{{ $itemName }}">x</button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="btn btn-success mt-4">Save</button>
        </form>
    </div>

    <!-- Pass selected items to JS -->
    <script>
        const selectedItems = @json($selectedItems);
        const bookingId = "{{ $booking->id }}";
        const activeCategory = {};
    </script>

    <script>
        function attachRemoveEvents() {
            document.querySelectorAll('.remove-item').forEach(button => {
                button.onclick = function() {
                    const li = this.closest('li');
                    const name = this.dataset.name;
                    const func = this.dataset.functionId;
                    const tab = this.dataset.tab;
                    const csrfToken = document.querySelector('input[name="_token"]').value;

                    fetch("{{ route('menu.removeItem') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                booking_id: bookingId,
                                function_id: func,
                                item_name: name
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                li.remove();

                                const index = selectedItems[func].indexOf(name);
                                if (index > -1) selectedItems[func].splice(index, 1);

                                showAddButton(name, func, tab);
                            }
                        });
                };
            });
        }

        document.querySelectorAll('.select-item').forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.dataset.tab;
                const name = this.dataset.name;
                const func = this.dataset.functionId;
                const buttonEl = this;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch("{{ route('menu.addItem') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            booking_id: bookingId,
                            function_id: func,
                            item_name: name
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            selectedItems[func] = selectedItems[func] || [];
                            selectedItems[func].push(name);

                            buttonEl.style.display = 'none';

                            const ul = document.getElementById('selected_' + tab);
                            const li = document.createElement('li');
                            li.className = 'list-group-item d-flex justify-content-between align-items-center';
                            li.setAttribute('data-name', name);
                            li.innerHTML = `
                        ${name}
                        <input type="hidden" name="selected_items[${func}][]" value="${name}">
                        <button type="button" class="btn btn-sm btn-danger remove-item" data-tab="${tab}" data-function-id="${func}" data-name="${name}">x</button>
                    `;
                            ul.appendChild(li);

                            attachRemoveEvents();
                        }
                    });
            });
        });

        // Category filtering (unchanged)
        document.querySelectorAll('.category').forEach(cat => {
            cat.addEventListener('click', function() {
                const tab = this.dataset.tab;
                const catId = this.dataset.cat;

                activeCategory[tab] = catId;

                document.querySelectorAll(`.tab_${tab}`).forEach(card => {
                    if (catId === 'all') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = card.dataset.cat === catId ? 'block' : 'none';
                    }
                });

                document.querySelectorAll(`.category[data-tab="${tab}"]`).forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });


        function showAddButton(name, func, tab) {
            const safeName = CSS.escape(name);
            const safeFunc = CSS.escape(func);

            document.querySelectorAll(`.select-item[data-name="${safeName}"][data-function-id="${safeFunc}"][data-tab="${tab}"]`)
                .forEach(btn => {
                    btn.style.display = 'inline-block';
                    btn.disabled = false;
                });
        }

        attachRemoveEvents();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>