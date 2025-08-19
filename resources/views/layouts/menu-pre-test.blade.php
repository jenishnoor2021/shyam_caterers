<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('front_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2>Menu Preparation for: {{ $booking->customer_name }} - {{ $booking->event }}</h2>

        <!-- Function Tabs -->
        <ul class="nav nav-tabs" id="functionTabs">
            @foreach ($functions as $index => $func)
            <li class="nav-item">
                <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#func_{{ $index }}">{{ strtoupper($func['type']) }}</a>
            </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('menu.store') }}">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <div class="tab-content mt-4">
                @foreach ($functions as $index => $func)
                <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="func_{{ $index }}">
                    <div class="row">
                        <!-- Categories -->
                        <div class="col-md-2 border-end">
                            <h6>Categories</h6>
                            <ul class="list-group">
                                @foreach ($categories as $cat)
                                <li class="list-group-item category" data-tab="{{ $index }}" data-cat="{{ $cat->id }}">{{ $cat->category_name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Items -->
                        <div class="col-md-6">
                            <div class="row" id="items_{{ $index }}">
                                @foreach ($items as $item)
                                <div class="col-md-4 mb-3 menu-item tab_{{ $index }}" data-cat="{{ $item->categories_id }}">
                                    <div class="card">
                                        <img src="{{ $item->file }}" class="card-img-top" style="height: 100px; object-fit: cover;">
                                        <div class="card-body">
                                            <h6>{{ $item->item_name }}</h6>
                                            <button type="button" class="btn btn-sm btn-primary select-item"
                                                data-tab="{{ $index }}"
                                                data-name="{{ $item->item_name }}"
                                                data-type="{{ $func['type'] }}">Add</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Selected -->
                        <div class="col-md-4">
                            <h6>Selected</h6>
                            <ul class="list-group" id="selected_{{ $index }}"></ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="btn btn-success mt-4">Save</button>
        </form>
    </div>


    <script>
        const selectedItems = {};

        document.querySelectorAll('.select-item').forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.dataset.tab;
                const name = this.dataset.name;
                const func = this.dataset.type;

                selectedItems[func] = selectedItems[func] || [];

                if (selectedItems[func].includes(name)) return;

                // Add to selected array
                selectedItems[func].push(name);

                // Hide button
                this.style.display = 'none';

                // Add item to selected list
                const ul = document.getElementById('selected_' + tab);
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.setAttribute('data-name', name);
                li.innerHTML = `
                ${name}
                <input type="hidden" name="selected_items[${func}][]" value="${name}">
                <button type="button" class="btn btn-sm btn-danger remove-item">x</button>
            `;

                ul.appendChild(li);

                // Remove item listener
                li.querySelector('.remove-item').addEventListener('click', function() {
                    li.remove();

                    // Remove from selected array
                    const index = selectedItems[func].indexOf(name);
                    if (index > -1) selectedItems[func].splice(index, 1);

                    // Show Add button again
                    document.querySelectorAll(`.select-item[data-name="${name}"][data-type="${func}"]`).forEach(btn => {
                        btn.style.display = 'inline-block';
                    });
                });
            });
        });

        // Category filter (unchanged)
        document.querySelectorAll('.category').forEach(cat => {
            cat.addEventListener('click', function() {
                const tab = this.dataset.tab;
                const catId = this.dataset.cat;

                document.querySelectorAll(`.tab_${tab}`).forEach(card => {
                    card.style.display = card.dataset.cat === catId ? 'block' : 'none';
                });
            });
        });
    </script>

    <!-- Required Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>