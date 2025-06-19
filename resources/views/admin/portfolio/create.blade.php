<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">إضافة عمل جديد</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow">
            <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block mb-1">عنوان العمل</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">وصف العمل</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">التصنيف</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2" required>
                        <option disabled selected>اختر تصنيفاً</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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
