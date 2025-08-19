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

        .fixed-height-scroll {
            max-height: 50vh;
            /* Adjust based on your UI preference */
            overflow-y: auto;
            overflow-x: hidden;
        }

        .card .btn {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2><a href="/bookings/{{$booking->id}}/edit" class="btn btn-secondary">Edit Customer Detail</a> Menu Preparation for: {{ $booking->customer_name }} - {{ $eventName }}</h2>

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
                        <div class="col-12 col-md-2 border-end mb-3 mb-md-0">
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
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div id="function_{{ $index }}" class="search-wrapper">
                                <!-- Search Box -->
                                <div class="mb-3">
                                    <input class="search form-control" placeholder="Search items..." />
                                </div>
                                <!-- List.js expects this class -->
                                <div class="row list fixed-height-scroll">
                                    @foreach ($items as $item)
                                    @php
                                    $isSelected = collect($alreadySelected)->pluck('item_id')->contains($item->id);
                                    @endphp
                                    <div class="col-md-4 mb-3 menu-item tab_{{ $index }} item" data-cat="{{ $item->categories_id }}">
                                        <div class="card h-100 d-flex flex-column">
                                            <img src="{{ $item->file }}" class="card-img-top" style="height: 100px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h6 class="name">{{ $item->item_name }}</h6>
                                                <button type="button"
                                                    class="btn btn-sm btn-primary select-item {{ $isSelected ? 'd-none' : '' }} mt-auto"
                                                    data-tab="{{ $index }}"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->item_name }}"
                                                    data-category-id="{{ $item->categories_id }}"
                                                    data-function-id="{{ $funcId }}">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Selected Items -->
                        <div class="col-12 col-md-4">
                            <h6>Selected</h6>
                            @php
                            $groupedByCategory = [];

                            foreach ($alreadySelected as $selected) {
                            $item = $itemsMap[$selected['item_id']] ?? null;
                            if (!$item) continue;

                            $categoryName = $item->Categories->category_name ?? 'Unknown';
                            $groupedByCategory[$categoryName][] = $item;
                            }
                            @endphp
                            <div id="selected_{{ $index }}">
                                @php $totalCount = 0; @endphp
                                @foreach ($groupedByCategory as $categoryName => $itemsGroup)
                                @php
                                $catId = strtolower(str_replace(' ', '_', $categoryName)) . '_' . $index;
                                $totalCount += count($itemsGroup);
                                @endphp
                                <div class="mb-2 border rounded category-group" data-cat="{{ $catId }}">
                                    <div class="d-flex justify-content-between align-items-center px-2 py-1 bg-secondary text-white category-toggle" data-bs-toggle="collapse" href="#collapse_{{ $catId }}" role="button" aria-expanded="true" aria-controls="collapse_{{ $catId }}">
                                        <strong>{{ strtoupper($categoryName) }}</strong>
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                    <div class="collapse show" id="collapse_{{ $catId }}">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($itemsGroup as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center" data-name="{{ $item->item_name }}" data-id="{{ $item->id }}">
                                                <span>{{ $item->item_name }}</span>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-danger remove-item"
                                                        data-tab="{{ $index }}"
                                                        data-function-id="{{ $funcId }}"
                                                        data-id="{{ $item->id }}">
                                                        X
                                                    </button>
                                                    <input type="hidden" name="selected_items[{{ $funcId }}][{{ $item->id }}]" value="{{ $item->categories_id }}">
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <p class="mt-2"><strong>Total Items: <span id="total_count_{{ $index }}">{{ $totalCount }}</span></strong></p>
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
                    const itemId = this.dataset.id;
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
                                item_id: itemId
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                const categoryGroup = li.closest('.category-group');
                                const ul = categoryGroup ? categoryGroup.querySelector('ul') : null;

                                // Remove the list item
                                li.remove();

                                if (ul && ul.children.length === 0 && categoryGroup) {
                                    categoryGroup.remove();
                                }

                                if (selectedItems[func]) {
                                    selectedItems[func] = selectedItems[func].filter(item => item.item_id !== parseInt(itemId));
                                }

                                updateTotalCount(tab, 'minus');

                                showAddButton(itemId, func, tab);
                            }
                        });
                };
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            attachRemoveEvents();

            document.querySelectorAll('.select-item').forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.dataset.tab;
                    const itemId = this.dataset.id;
                    const name = this.dataset.name;
                    const categoryId = this.dataset.categoryId;
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
                                item_id: itemId,
                                category_id: categoryId
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                selectedItems[func] = selectedItems[func] || [];
                                selectedItems[func].push({
                                    item_id: parseInt(itemId),
                                    category_id: parseInt(categoryId)
                                });

                                // buttonEl.style.display = 'none';
                                buttonEl.classList.add('d-none');

                                const selectedContainer = document.getElementById('selected_' + tab);
                                const categoryName = data.category_name || 'Unknown';
                                const catId = categoryName.toLowerCase().replace(/\s+/g, '_') + '_' + tab;

                                let categoryBlock = document.getElementById('collapse_' + catId);
                                if (!categoryBlock) {
                                    const newCategoryHTML = `
                        <div class="mb-2 border rounded category-group" data-cat="${catId}">
                            <div class="d-flex justify-content-between align-items-center px-2 py-1 bg-secondary text-white category-toggle"
                                data-bs-toggle="collapse" href="#collapse_${catId}" role="button"
                                aria-expanded="true" aria-controls="collapse_${catId}">
                                <strong>${categoryName.toUpperCase()}</strong>
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div class="collapse show" id="collapse_${catId}">
                                <ul class="list-group list-group-flush"></ul>
                            </div>
                        </div>
                    `;
                                    selectedContainer.insertAdjacentHTML('beforeend', newCategoryHTML);
                                }

                                const ul = document.querySelector(`#collapse_${catId} ul`);
                                const li = document.createElement('li');
                                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                                li.setAttribute('data-name', name);
                                li.setAttribute('data-id', itemId);
                                li.innerHTML = `
                        <span>${name}</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle me-2"></i>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item"
                            data-tab="${tab}" data-function-id="${func}" data-id="${itemId}">
                            X
                        </button>
                        <input type="hidden" name="selected_items[${func}][${itemId}]" value="${categoryId}">
                    </div>
                    `;
                                ul.appendChild(li);

                                updateTotalCount(tab, 'plus');

                                attachRemoveEvents();
                            }
                        });
                });
            });

            // Re-enable any hidden "Add" buttons based on selectedItems
            Object.keys(selectedItems).forEach(func => {
                selectedItems[func].forEach(item => {
                    showAddButton(item.item_id, func);
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


        function showAddButton(itemId, func, tab) {

            console.log('Trying to show Add button for', itemId, func, tab);

            let found = false;
            document.querySelectorAll(`.select-item[data-id="${itemId}"][data-function-id="${func}"][data-tab="${tab}"]`)
                .forEach(btn => {
                    btn.classList.remove('d-none');
                    btn.disabled = false;
                    found = true;
                });

            if (!found) {
                console.warn(`Add button not found for itemId=${itemId}, func=${func}, tab=${tab}`);
            }
        }

        function updateTotalCount(tab, operation) {
            const totalCountEl = document.getElementById('total_count_' + tab);

            if (totalCountEl) {
                let currentCount = parseInt(totalCountEl.textContent);

                if (operation === 'minus') {
                    totalCountEl.textContent = currentCount - 1;
                } else if (operation === 'plus') {
                    totalCountEl.textContent = currentCount + 1;
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

    <script>
        // Initialize List.js for each tab
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[id^="function_"]');

            tabs.forEach(tab => {
                const options = {
                    valueNames: ['name'], // What to search (class name)
                    listClass: 'list' // List container class
                };

                new List(tab.id, options);
            });
        });
    </script>
</body>

</html>