<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">
                    تعديل العمل
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    تحديث بيانات العمل: "{{ $portfolio->title }}"
                </p>
            </div>
            <a href="{{ route('admin.portfolio.index') }}"
               class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
                العودة للأعمال
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl p-8">

                {{-- رسالة عرض الأخطاء العامة --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 text-red-800 p-4 rounded-r-lg" role="alert">
                        <p class="font-bold mb-1">حدث خطأ:</p>
                        <ul class="list-disc pr-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST"
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- مجموعة حقول الإدخال --}}
                    <div class="space-y-6">
                        {{-- حقل عنوان العمل --}}
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">عنوان العمل</label>
                            <input type="text" name="title" id="title"
                                   value="{{ old('title', $portfolio->title) }}"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('title') border-red-500 @enderror">
                            @error('title')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- حقل وصف العمل --}}
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">وصف العمل</label>
                            <textarea name="description" id="description" rows="4"
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description', $portfolio->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- حقل التصنيف --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">التصنيف</label>
                            <select name="category_id" id="category_id"
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category_id', $portfolio->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- حقل رابط المشروع --}}
                        <div>
                            <label for="project_url" class="block text-sm font-medium text-gray-700">رابط المشروع (اختياري)</label>
                            <input type="url" name="project_url" id="project_url"
                                   value="{{ old('project_url', $portfolio->project_url) }}"
                                   placeholder="https://example.com"
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>

                    {{-- مجموعة حقول رفع الصور --}}
                    <div class="space-y-6 border-t border-gray-200 pt-6">
                        {{-- حقل تغيير الصورة الرئيسية --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">تغيير الصورة الرئيسية</label>
                            <input type="file" name="image" id="image"
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            @if ($portfolio->image_path)
                                <div class="mt-4">
                                    <p class="text-xs text-gray-500 mb-2">الصورة الحالية:</p>
                                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" alt="الصورة الحالية"
                                         class="w-full h-auto max-h-64 object-cover rounded-lg border border-gray-300">
                                </div>
                            @endif
                        </div>

                        {{-- حقل إضافة صور جديدة للمعرض --}}
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700">إضافة صور أخرى للمعرض</label>
                            <input type="file" name="images[]" id="images" multiple
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        </div>

                        {{-- عرض وحذف الصور الحالية في المعرض --}}
                        @if ($portfolio->images && $portfolio->images->count())
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الصور الحالية في المعرض</label>
                                <p class="text-xs text-gray-500 mb-2">حدد الصور التي ترغب في حذفها:</p>
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-2">
                                    @foreach ($portfolio->images as $image)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="صورة من المعرض"
                                                 class="w-full h-28 object-cover border rounded-lg shadow-sm">
                                            <label class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 cursor-pointer">
                                                <input type="checkbox" name="deleted_images[]"
                                                       value="{{ $image->id }}"
                                                       class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- أزرار الإجراءات (حفظ وإلغاء) --}}
                    <div class="flex justify-end pt-6 border-t border-gray-200 space-x-4 space-x-reverse">
                        <button type="submit"
                                class="inline-flex justify-center px-5 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            حفظ التعديلات
                        </button>
                        <a href="{{ route('admin.portfolio.index') }}"
                           class="px-5 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                            إلغاء
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
