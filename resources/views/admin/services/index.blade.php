<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                إدارة الخدمات
            </h2>
            <a href="{{ route('admin.services.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                إضافة خدمة جديدة
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-right">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="w-1/4 px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    العنوان</th>
                                <th
                                    class="w-1/4 px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    الوصف</th>
                                <th
                                    class="w-1/3 px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    الصورة</th>
                                <th
                                    class="w-1/12 px-6 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($services as $service)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                        {{ $service->title }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm text-gray-600 max-w-xs whitespace-nowrap overflow-hidden text-ellipsis">
                                        {{ $service->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($service->image)
                                            <img src="{{ asset('storage/' . $service->image) }}"
                                                alt="{{ $service->title }}"
                                                class="h-14 w-14 object-cover rounded shadow-sm border border-gray-200">
                                        @else
                                            <span class="text-xs text-gray-400">لا يوجد</span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 whitespace-nowrap">
                                        <div class="flex justify-center items-center gap-2">

                                            <a href="{{ route('admin.services.edit', $service->id) }}"
                                                class="inline-flex items-center justify-center w-9 h-9 text-blue-600 hover:text-white hover:bg-blue-600 transition rounded-full border border-blue-100"
                                                title="تعديل">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>

                                 
                                            <form action="{{ route('admin.services.destroy', $service->id) }}"
                                                method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-9 h-9 text-red-600 hover:text-white hover:bg-red-600 transition rounded-full border border-red-100"
                                                    title="حذف">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-12">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 13h6m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد خدمات حالياً</h3>
                                            <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة خدمة جديدة لعرضها هنا.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
