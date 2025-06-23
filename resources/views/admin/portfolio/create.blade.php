<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">إضافة عمل جديد</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 text-red-800 p-4 rounded-r-lg" role="alert">
                        <p class="font-bold mb-1">حدث خطأ</p>
                        <ul class="list-disc pr-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <label class="block mb-1">عنوان العمل</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2">
                    @error('title')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">وصف العمل</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">التصنيف</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2">
                        <option disabled selected>اختر تصنيفاً</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-1">رابط المشروع</label>
                    <input type="url" name="project_url" class="w-full border rounded px-3 py-2"
                        placeholder="https://example.com">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">الصور</label>
                    <div id="image-inputs">
                        <input type="file" name="images[]" class="w-full mb-2">
                    </div>
                    <button type="button" id="add-image" class="text-sm text-blue-600 hover:underline">+ إضافة صورة
                        أخرى</button>
                </div>
                @error('images')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
             
                @foreach ($errors->get('images.*') as $message)
                    <p class="mt-1 text-xs text-red-600">{{ $message[0] }}</p>
                @endforeach

                <button class="bg-blue-600 text-white px-4 py-2 rounded">حفظ</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-image').addEventListener('click', function() {
            const container = document.getElementById('image-inputs');
            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'images[]';
            input.className = 'w-full mb-2';
            container.appendChild(input);
        });
    </script>
</x-app-layout>
