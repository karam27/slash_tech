<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800 leading-tight">إضافة خدمة جديدة</h2>
                <p class="text-sm text-gray-500 mt-1">قم بإدخال تفاصيل الخدمة بشكل دقيق.</p>
            </div>
            <a href="{{ route('admin.services.index') }}"
                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition duration-200">
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

                {{-- النموذج --}}
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    {{-- عنوان الخدمة --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">عنوان الخدمة</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="مثل: تصميم موقع إلكتروني"> {{-- <<< تم حذف required من هنا --}}
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- وصف الخدمة --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">وصف الخدمة</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="اكتب تفاصيل الخدمة هنا">{{ old('description') }}</textarea> {{-- <<< تم حذف required من هنا --}}
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- صورة الخدمة --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">صورة الخدمة</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" />
                                </svg>
                                <div class="flex justify-center text-sm text-gray-600 mt-2">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>اختر صورة</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                    <span class="pl-2">أو اسحبها هنا</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG حتى 10MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- الأزرار --}}
                    <div class="flex justify-end gap-3 border-t pt-6">
                        <a href="{{ route('admin.services.index') }}"
                            class="px-5 py-2 border border-gray-300 text-sm rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            إلغاء
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                            حفظ الخدمة
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
