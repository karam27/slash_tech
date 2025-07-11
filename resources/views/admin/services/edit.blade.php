<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">
                    تعديل الخدمة
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    تحديث بيانات الخدمة: "{{ $service->title }}"
                </p>
            </div>
            <a href="{{ route('admin.services.index') }}"
                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
                <span>العودة للخدمات</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl p-8">


                {{-- التنبيهات --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-300 text-red-800 p-4 rounded-lg" role="alert">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M4.293 6.293a1 1 0 011.414 0L12 12.586l6.293-6.293a1 1 0 011.414 1.414L13.414 14l6.293 6.293a1 1 0 01-1.414 1.414L12 15.414l-6.293 6.293a1 1 0 01-1.414-1.414L10.586 14 4.293 7.707a1 1 0 010-1.414z" />
                            </svg>
                            <div>
                                <p class="font-semibold">حدثت الأخطاء التالية:</p>
                                <ul class="list-disc pr-5 mt-2 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- عنوان الخدمة --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">عنوان
                            الخدمة</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}"
                            class="block w-full px-4 py-2 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- وصف الخدمة --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">وصف
                            الخدمة</label>
                        <textarea name="description" id="description" rows="4"
                            class="block w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- حقول الصورة --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                        {{-- رفع صورة جديدة --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                تغيير صورة الخدمة (اختياري)
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 @error('image') border-red-500 @else border-gray-300 @enderror border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>اختر صورة</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">أو اسحبها وأفلتها هنا</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- الصورة الحالية وخيار الحذف --}}
                        @if ($service->image)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الصورة الحالية</label>
                                <div class="mt-1">
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="الصورة الحالية"
                                        class="w-full h-auto object-cover rounded-lg shadow-md border border-gray-200">
                                </div>

                            </div>
                        @endif
                    </div>

                    {{-- الأزرار --}}
                    <div
                        class="flex items-center justify-end space-x-4 space-x-reverse pt-6 border-t border-gray-200 mt-6">
                        <a href="{{ route('admin.services.index') }}"
                            class="px-5 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                            إلغاء
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center px-5 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            حفظ التعديلات
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
