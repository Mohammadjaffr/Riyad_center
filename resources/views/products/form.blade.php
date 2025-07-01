{{-- ملفات الأخطاء --}}
@if ($errors->any())
    <div class="alert alert-danger text-end">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4 align-items-center">
    <div class="col-12 col-md-8">
        <div class="row g-3">
            {{-- اسم المنتج --}}
            <div class="col-12">
                <label class="form-label fw-bold">اسم المنتج</label>
                <input type="text" name="name"
                       class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       placeholder="اسم المنتج" style="text-align: right"
                       value="{{ old('name', $product->name ?? '') }}">
                @error('name')
                <span class="invalid-feedback text-end d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- القسم --}}
            <div class="col-6">
                <label class="form-label fw-bold">القسم</label>
                <select name="department_id"
                        class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('department_id') ? 'is-invalid' : '' }}"
                        style="text-align: right" >
                    <option>القسم</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id', $product->department_id ?? '') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                <span class="invalid-feedback text-end d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            {{-- رقم الموديل --}}
            <div class="col-6">
                <label class="form-label fw-bold">رقم الموديل</label>
                <input type="text" name="model_num"
                       class="summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('model_num') ? 'is-invalid' : '' }}"
                       style="text-align: right; width: 200px" placeholder="رقم الموديل"
                       value="{{ old('model_num', $product->model_num ?? '') }}">
                @error('model_num')
                <span class="invalid-feedback text-end d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            {{-- الوصف --}}
            <div class="col-12">
                <label class="form-label fw-bold">الوصف</label>
                <textarea name="description"
                          style="text-align: right;"
                          class="summary-textarea flex-grow-1 w-100 w-md-auto {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                <span class="invalid-feedback text-end d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>



            {{-- صورة المنتج --}}
            <div class="col-12">
                <label class="form-label fw-bold">صورة المنتج</label>
                <input type="file" name="product_image"
                       class="form-control summary-input flex-grow-1 w-100 w-md-auto {{ $errors->has('product_image') ? 'is-invalid' : '' }}"
                       accept="image/*" onchange="previewProductImage(event)">
                @error('product_image')
                <span class="invalid-feedback text-end d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            {{-- المتغيرات (مقاس، لون، سعر بيع، تكلفة) --}}

            <div class="col-12 ">
                <h5 class="mt-2 text-dark-blue">المقاسات والألوان والأسعار</h5>

                <div id="variants-container">
                    @php
                        $oldVariants = old('variants', $product->variants ?? []);
                    @endphp

                    @if(count($oldVariants) > 0)
                        @foreach($oldVariants as $index => $variant)
                            <div class="variant-item mb-3 p-3 border rounded" data-index="{{ $index }}" >
                                <div class="row g-3 align-items-center">
                                    <div class="col-2">
                                        <select name="variants[{{ $index }}][size]" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue" required>
                                            <option value="" disabled {{ empty($variant['size']) ? 'selected' : '' }}>اختر المقاس</option>
                                            <option value="XS" {{ (isset($variant['size']) && $variant['size'] == 'XS') ? 'selected' : '' }}>XS</option>
                                            <option value="S" {{ (isset($variant['size']) && $variant['size'] == 'S') ? 'selected' : '' }}>S</option>
                                            <option value="M" {{ (isset($variant['size']) && $variant['size'] == 'M') ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ (isset($variant['size']) && $variant['size'] == 'L') ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ (isset($variant['size']) && $variant['size'] == 'XL') ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ (isset($variant['size']) && $variant['size'] == 'XXL') ? 'selected' : '' }}>XXL</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" name="variants[{{ $index }}][color]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="اللون" value="{{ $variant['color'] ?? '' }}" required>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" name="variants[{{ $index }}][quantity]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="كمية المخزون" min="0" value="{{ $variant['quantity'] ?? 0 }}" required>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" step="0.01" name="variants[{{ $index }}][sell_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر البيع" value="{{ $variant['sell_price'] ?? '' }}" required>
                                    </div>
                                    <div class="col-2">
                                        <input type="number" step="0.01" name="variants[{{ $index }}][cost_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر التكلفة" value="{{ $variant['cost_price'] ?? '' }}" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-variant-btn"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- أول متغير افتراضي --}}
                        <div class="variant-item mb-3 p-3 border rounded" data-index="0">
                            <div class="row g-3 align-items-center">
                                <div class="col-2">
                                    <select name="variants[0][size]" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue" required>
                                        <option value="" disabled selected>اختر المقاس</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="text" name="variants[0][color]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="اللون" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="variants[0][quantity]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="كمية المخزون" min="0" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" name="variants[0][sell_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر البيع" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" name="variants[0][cost_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر التكلفة" required>
                                </div>
                                <div class="col-2 ">
                                    <button type="button" class="btn btn-danger btn-sm remove-variant-btn"><i class="fa fa-trash"></i> </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" id="add-variant-btn" class="btn btn-outline-blue btn-sm mt-2">إضافة متغير جديد</button>
            </div>

        </div>
    </div>

    <div class="col-12 col-md-4 text-center order-1 order-md-0 mb-3 mb-md-0">
        <img id="product-preview" src="{{ asset('assets/images/Add files-rafiki.png') }}" alt="Product Illustration"
             class="img-fluid" style="max-width: 220px;">
    </div>
</div>

{{-- سكريبت لإضافة وحذف المتغيرات --}}
<script>
    let variantIndex = {{ count($oldVariants) > 0 ? count($oldVariants) : 1 }};

    document.getElementById('add-variant-btn').addEventListener('click', function() {
        const container = document.getElementById('variants-container');

        const html = `
<div class="variant-item mb-3 p-3 border rounded" data-index="${variantIndex}">
    <div class="row g-3 align-items-center">
        <div class="col-2">
            <select name="variants[${variantIndex}][size]" class="summary-input flex-grow-1 w-100 w-md-auto text-dark-blue" required>
                <option value="" disabled selected>اختر المقاس</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </div>
        <div class="col-2">
            <input type="text" name="variants[${variantIndex}][color]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="اللون" required>
        </div>
        <div class="col-2">
<input type="number" name="variants[${variantIndex}][quantity]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="كمية المخزون" min="0" required>
        </div>
        <div class="col-2">
            <input type="number" step="0.01" name="variants[${variantIndex}][sell_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر البيع" required>
        </div>
        <div class="col-2">
            <input type="number" step="0.01" name="variants[${variantIndex}][cost_price]" class="summary-input flex-grow-1 w-100 w-md-auto" placeholder="سعر التكلفة" required>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger btn-sm remove-variant-btn"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;


        container.insertAdjacentHTML('beforeend', html);
        variantIndex++;
    });


    // حذف متغير
    document.getElementById('variants-container').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-variant-btn')) {
            const variantDiv = e.target.closest('.variant-item');
            variantDiv.remove();
        }
    });

    // عرض معاينة الصورة عند اختيار صورة جديدة
    function previewProductImage(event) {
        const input = event.target;
        const preview = document.getElementById('product-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
