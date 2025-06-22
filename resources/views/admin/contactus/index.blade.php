<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            إدارة الرسائل
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                    <thead>
                        <tr>
                            <th class="text-right py-2">الاسم</th>
                            <th class="text-right py-2">الإيميل</th>
                            <th class="text-right py-2">رقم الهاتف</th>
                            <th class="text-right py-2">الرسالة</th>
                            <th class="text-right py-2">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr class="border-b">
                                <td class="py-2">{{ $message->full_name }}</td>
                                <td class="py-2">{{ $message->email }}</td>
                                <td class="py-2">{{ $message->phone }}</td>
                                <td class="py-2 max-w-md whitespace-normal">{{ $message->message_body }}</td>
                                <td class="py-2">
                                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if ($messages->isEmpty())
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">لا توجد رسائل حالياً.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
