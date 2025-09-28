<?php

use App\Models\Functio;
use Illuminate\Support\Facades\File;
?>

@extends('layouts.front')

@section('page_style')
<!-- <link href="{{ asset('front_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
<style>
  .category {
    cursor: pointer;
  }

  .booking-form .card {
    width: 100%;
  }
</style>
@endsection

@section('content')
<!-- Inner Banner Section -->
<section class="inner-banner">
  <div class="image-layer" style="background-image: url({{ asset('front_assets/images/resource/aboutbg.jpg') }})"></div>
  <div class="auto-container">
    <div class="inner">
      <h1><span>Menu Preparation</span></h1>
    </div>
  </div>
</section>
<style>
  .inner-banner {
    padding: 100px 0 100px !important;
  }

  @media(max-width: 991px) {
    .inner-banner {
      padding: 100px 0 0 !important;
    }
  }
</style>
<!--End Banner Section -->

<section class="booking-form team-section form">
  <div class="left-bot-bg"><img src="{{ asset('front_assets/images/background/bg-1.png') }}" alt=""
      title=""></div>
  <div class="right-top-bg"><img src="{{ asset('front_assets/images/background/bg-6.png') }}" alt=""
      title=""></div>
  <div class="auto-container">
    <div class="card shadow">
      <div class="card-body">
        <h4 style="display: flex;align-items: center;flex-wrap: wrap;justify-content: center;gap: 20px;">
          <a href="/bookings/{{ $booking->id }}/edit" class="theme-btn btn-style-one clearfix">
            <span class="btn-wrap">
              <span class="text-one">Edit Customer Detail</span>
              <span class="text-two">Edit Customer Detail</span>
            </span>
          </a>
          - Menu Preparation for: <span style="color:var(--main-color)">{{ $booking->customer_name }}</span>
        </h4>
        <ul class="nav nav-tabs mt-4" id="functionTabs" role="tablist">
          @foreach ($functions as $index => $func)
          @php
          $getDetail = Functio::find($func['fun_id']);
          $name = $getDetail ? $getDetail->function_type : 'Unknown';
          @endphp
          <li class="nav-item" role="presentation">
            <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab"
              href="#func_{{ $index }}" aria-selected="true"
              role="tab">{{ strtoupper($name) }}</a>
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
            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
              id="func_{{ $index }}" role="tabpanel">
              <div class="row">
                <!-- Categories -->
                <div class="col-12 col-md-2 border-end mb-3 mb-md-0 category">
                  <h6>Categories</h6>
                  <ul class="list-group">
                    <li class="list-group-item category active" data-tab="{{ $index }}"
                      data-cat="all">
                      ALL ITEMS
                    </li>
                    @foreach ($categories as $cat)
                    <li class="list-group-item category" data-tab="{{ $index }}"
                      data-cat="{{ $cat->id }}">
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
                      <input class="search form-control" placeholder="Search items...">
                    </div>
                    <!-- List.js expects this class -->
                    <div class="row list fixed-height-scroll">
                      @foreach ($items as $item)
                      @php
                      $isSelected = collect($alreadySelected)
                      ->pluck('item_id')
                      ->contains($item->id);

                      $imagePath = public_path($item->file);
                      $imageUrl = asset(
                      File::exists($imagePath) && $item->file
                      ? $item->file
                      : 'defaults/no-image-available.png',
                      );

                      @endphp
                      <div class="col-md-4 mb-3 menu-item tab_{{ $index }} item"
                        data-cat="{{ $item->categories_id }}">
                        <div class="card h-100 d-flex flex-column">
                          <img src="{{ $imageUrl }}" class="card-img-top"
                            style="aspect-ratio: 2/1.5; object-fit: cover;">
                          <div
                            class="card-body d-flex flex-column justify-content-between">
                            <h6 class="name">{{ $item->item_name }}</h6>
                            <button type="button"
                              class="btn btn-sm btn-primary select-item {{ $isSelected ? 'd-none' : '' }} mt-auto"
                              data-tab="{{ $index }}"
                              data-id="{{ $item->id }}"
                              data-name="{{ $item->item_name }}"
                              data-category-id="{{ $item->categories_id }}"
                              data-function-id="{{ $funcId }}"
                              data-person="{{ $func['person'] }}"
                              data-datetime="{{ $func['datetime'] }}">
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
                <!-- <div class="col-12 col-md-4 category category--block"> -->
                <div class="col-12 col-md-4 category category--block">
                  <h6>Selected Items</h6>
                  @php
                  $groupedByCategory = [];

                  foreach ($alreadySelected as $selected) {
                  $item = $itemsMap[$selected['item_id']] ?? null;
                  if (!$item) {
                  continue;
                  }

                  $categoryName = $item->Categories->category_name ?? 'Unknown';
                  $groupedByCategory[$categoryName][] = $item;
                  }
                  @endphp
                  <div id="selected_{{ $index }}">
                    @php $totalCount = 0; @endphp
                    @foreach ($groupedByCategory as $categoryName => $itemsGroup)
                    @php
                    $catId =
                    strtolower(str_replace(' ', '_', $categoryName)) .
                    '_' .
                    $index;
                    $totalCount += count($itemsGroup);
                    @endphp
                    <div class="mb-3 border rounded category-group"
                      data-cat="{{ $catId }}">
                      <div class="d-flex justify-content-between align-items-center px-2 py-1 bg-secondary text-white category-toggle"
                        data-bs-toggle="collapse" href="#collapse_{{ $catId }}"
                        role="button" aria-expanded="true"
                        aria-controls="collapse_{{ $catId }}">
                        <strong>{{ strtoupper($categoryName) }}</strong>
                        <i class="bi bi-info-circle"></i>
                      </div>
                      <div class="collapse show" id="collapse_{{ $catId }}">
                        <ul class="list-group list-group-flush">
                          @foreach ($itemsGroup as $item)
                          <li class="list-group-item d-flex justify-content-between align-items-center"
                            data-name="{{ $item->item_name }}"
                            data-id="{{ $item->id }}">
                            <span>{{ $item->item_name }}</span>
                            <div class="d-flex align-items-center">
                              <i class="bi bi-info-circle me-2"></i>
                              <button type="button"
                                class="btn btn-sm btn-outline-danger remove-item"
                                data-tab="{{ $index }}"
                                data-function-id="{{ $funcId }}"
                                data-id="{{ $item->id }}"
                                data-person="{{ $func['person'] }}"
                                data-datetime="{{ $func['datetime'] }}">
                                <i class="fa fa-trash"></i>
                              </button>
                              <input type="hidden"
                                name="selected_items[{{ $funcId }}][{{ $item->id }}]"
                                value="{{ $item->categories_id }}">
                            </div>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  <p class="mt-2"><strong>Total Items: <span
                        id="total_count_{{ $index }}">{{ $totalCount }}</span></strong>
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <button type="submit" class="theme-btn btn-style-one clearfix mt-4" style="margin-top: 30px;">
            <span class="btn-wrap">
              <span class="text-one">Save & Preview</span>
              <span class="text-two">Save & Preview</span>
            </span>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('page_script')
<script>
  const selectedItems = @json($selectedItems);
  const bookingId = "{{ $booking->id }}";
  const activeCategory = {};
</script>

<script>
  function attachRemoveEvents() {
    document.querySelectorAll('.remove-item').forEach(button => {
      button.onclick = function() {

        const confirmed = confirm("Are you sure you want to remove this item?");
        if (!confirmed) return;

        const li = this.closest('li');
        const itemId = this.dataset.id;
        const func = this.dataset.functionId;
        const personValue = this.dataset.person;
        const datetimeValue = this.dataset.datetime;
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
              person: personValue,
              datetime: datetimeValue,
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
                selectedItems[func] = selectedItems[func].filter(item => item
                  .item_id !== parseInt(itemId));
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
        const personValue = this.dataset.person;
        const datetimeValue = this.dataset.datetime;
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
              person: personValue,
              datetime: datetimeValue,
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

              const selectedContainer = document.getElementById('selected_' +
                tab);
              const categoryName = data.category_name || 'Unknown';
              const catId = categoryName.toLowerCase().replace(/\s+/g, '_') +
                '_' + tab;

              let categoryBlock = document.getElementById('collapse_' +
                catId);
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
                selectedContainer.insertAdjacentHTML('beforeend',
                  newCategoryHTML);
              }

              const ul = document.querySelector(`#collapse_${catId} ul`);
              const li = document.createElement('li');
              li.className =
                'list-group-item d-flex justify-content-between align-items-center';
              li.setAttribute('data-name', name);
              li.setAttribute('data-id', itemId);
              li.innerHTML = `
                        <span>${name}</span>
                        <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle me-2"></i>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-item"
                            data-tab="${tab}" data-function-id="${func}" data-id="${itemId}" data-person="${personValue}" data-datetime="${datetimeValue}">
                            <i class="fa fa-trash"></i>
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

      document.querySelectorAll(`.category[data-tab="${tab}"]`).forEach(el => el.classList.remove(
        'active'));
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
@endsection