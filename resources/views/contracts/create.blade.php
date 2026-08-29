<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء عقد | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 font-sans text-slate-700">
    <main class="mx-auto w-full  space-y-5 px-4 py-5 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800">
                {{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contracts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="client_id" value="{{ optional($client)->id }}">

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <header
                    class="border-b border-slate-200 bg-gradient-to-br from-slate-50 via-white to-emerald-50/40 px-5 py-6 sm:px-8 sm:py-8">
                    <div class="flex flex-col items-stretch gap-4 lg:flex-row lg:justify-evenly">

                        <div
                            class="order-1 flex h-32 w-full shrink-0 items-center justify-center p-0 sm:h-32 lg:h-36 lg:w-52">
                            <img class="h-full w-full object-contain" src="{{ asset('images/new-logo1.png') }}"
                                alt="أمر تم">
                        </div>

                        <div
                            class="order-2 flex min-w-0 flex-1 items-center rounded-2xl border border-slate-200 px-4 py-3 shadow-sm sm:h-32 lg:h-36">
                            <div class="grid w-fit grid-cols-3 sm:grid-cols-5 gap-x-3 gap-y-2 text-[11px] bg-red-300">

                                <div class="flex flex-col gap-1 bg-amber-900 w-fit">
                                    <span class="font-bold text-slate-500 whitespace-nowrap">نوع العقد</span>
                                    <select id="contract_type_id" name="contract_type_id" required
                                        class="w-24 rounded-lg border border-slate-200 bg-white px-1.5 py-2 text-right text-slate-800 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                        @foreach ($contractTypes ?? [] as $type)
                                            <option value="{{ $type->id }}" data-price="{{ $type->price }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-col gap-1 bg-amber-900 w-fit">
                                    <span class="font-bold text-slate-500 whitespace-nowrap">المدة (السنوات)</span>
                                    <input id="duration_years" name="duration_years" type="number" value="1"
                                        min="1" readonly
                                        class="w-24 rounded-lg border border-slate-200 bg-slate-100 px-1.5 py-2 text-center font-extrabold text-slate-800 outline-none">
                                </div>

                                <div class="flex flex-col gap-1 bg-amber-500 w-fit">
                                    <span class="font-bold text-slate-500 whitespace-nowrap">بداية العقد</span>
                                    <input id="start_date" name="start_date" type="date"
                                        value="{{ $defaultStartDate ?? now()->toDateString() }}" required
                                        class="w-35 rounded-lg border border-slate-200 bg-white px-1.5 py-2 text-slate-700 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                </div>

                                <div class="flex flex-col gap-1 bg-amber-400 w-fit">
                                    <span class="font-bold text-slate-500 whitespace-nowrap">نهاية العقد</span>
                                    <input id="end_date" name="end_date" type="date"
                                        value="{{ $defaultEndDate ?? now()->addYear()->toDateString() }}" required
                                        class="w-35 rounded-lg border border-slate-200 bg-white px-1.5 py-2 text-slate-700 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200">
                                </div>

                                <div class="flex flex-col gap-1 bg-amber-100 w-fit">
                                    <span class="font-bold text-slate-500 whitespace-nowrap">رقم العقد</span>
                                    <input id="contract_number" type="text"
                                        value="{{ App\Models\Contract::generateNextContractNumber() }}" readonly
                                        class="w-full rounded-lg border border-slate-200 bg-slate-100 px-1.5 py-2 text-center font-extrabold text-slate-800 outline-none">
                                </div>

                            </div>
                        </div>

                    </div>
                </header>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <header
                    class="flex items-center justify-between gap-4 border-b border-slate-700 bg-slate-800 px-5 py-4 sm:px-7 justify-center">
                    <div>
                        <h2 class="mt-1 text-xl font-extrabold text-white">عقد سنوي الكتروني</h2>
                    </div>
                </header>

                <div class="bg-slate-50/70 p-5 sm:p-7">
                    <div class="grid gap-5 lg:grid-cols-2">
                        @foreach ([['title' => 'الطرف الأول', 'data' => $company], ['title' => 'الطرف الثاني', 'data' => $client]] as $party)
                            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                                <div
                                    class="flex items-center gap-3 border-b border-slate-200 px-5 py-4 bg-slate-800 justify-center">
                                    <h3 class="text-base font-extrabold text-white">{{ $party['title'] }}</h3>
                                </div>
                                <dl class="divide-y divide-slate-100 text-sm">
                                    @foreach ([['label' => 'اسم المنشأة', 'value' => optional($party['data'])->name ?? ($party['title'] === 'الطرف الأول' ? 'مؤسسة آمر تم لخدمات الأعمال' : '—')], ['label' => 'الرقم الوطني الموحد', 'value' => optional($party['data'])->commercial_registration ?? '—'], ['label' => 'العنوان', 'value' => optional($party['data'])->address ?? '—'], ['label' => 'البريد الإلكتروني', 'value' => optional($party['data'])->email ?? '—'], ['label' => 'رقم الجوال', 'value' => optional($party['data'])->phone ?? '—'], ['label' => 'ويمثلها المدير العام', 'value' => optional($party['data'])->manager_name ?? '—']] as $item)
                                        <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                            <dt class="font-bold text-slate-500">{{ $item['label'] }}</dt>
                                            <dd class="col-span-2 wrap-break-word font-medium text-slate-700">
                                                {{ $item['value'] }}
                                            </dd>
                                        </div>
                                    @endforeach
                                </dl>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
                <div id="clausesContainer" class="space-y-3">
                    @php
                        $firstClause = $contractTerms->firstWhere('contract_term_name', 'التمهيد');
                        $otherClauses = $contractTerms->where('contract_term_name', '!=', 'التمهيد');
                    @endphp

                    @if ($firstClause)
                        <article class="flex rounded-xl sm:p-2">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-2xl font-black leading-tight text-slate-800">
                                    {{ $firstClause->contract_term_name }}
                                </h2>

                                <p class="-mt-4 whitespace-pre-line text-sm leading-6 text-slate-600">
                                    {{ $firstClause->contract_term_description }}
                                </p>
                        </article>
                    @endif

                    @forelse ($otherClauses ?? collect() as $clause)
                        <article
                            class="flex gap-4 rounded-xl border border-slate-200 border-r-4 border-r-slate-600 bg-slate-50 p-4 sm:p-5">
                            <span
                                class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-slate-200 text-sm font-extrabold text-slate-700">{{ $loop->iteration }}</span>
                            <div class="min-w-0 flex-1">
                                <h2 class="mb-2 text-lg font-extrabold text-slate-800 justify-center">
                                    {{ $clause->contract_term_name }}</h2>
                                <p class="whitespace-pre-line text-sm leading-7 text-slate-600 -mt-4">
                                    {{ $clause->contract_term_description }}</p>
                            </div>
                            <input type="hidden" name="clause_ids[]" value="{{ $clause->id }}">
                        </article>
                    @empty<p class="rounded-xl bg-slate-50 p-8 text-center text-sm text-slate-500">لا
                            توجد بنود مضافة حالياً</p>
                    @endforelse
                    <article
                        class="flex gap-4 rounded-xl border border-slate-200 border-r-4 border-r-slate-600 bg-slate-50 p-4 sm:p-5">
                        <div class="min-w-0 flex-1">
                            <h2 class="mb-2 text-lg font-extrabold text-slate-800 justify-center">
                                بند الإلتزامات المالية </h2>
                            <p class="whitespace-pre-line text-sm leading-7 text-slate-600 -mt-4">
                                <input id="price" name="price" type="number" step="0.01" min="0"
                                    value="{{ optional(($contractTypes ?? collect())->first())->price ?? 0 }}"
                                    readonly
                                    class="w-full rounded-lg border border-emerald-200 bg-emerald-50 px-1.5 py-2 text-center font-extrabold text-emerald-800 outline-none">
                            </p>
                        </div>
                        <input type="hidden" name="clause_ids[]" value="{{ $clause->id }}">
                    </article>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
                <div
                    class="mb-5 flex flex-wrap items-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm text-slate-600">
                    <span
                        class="grid h-5 w-5 place-items-center rounded-full bg-slate-600 text-xs font-bold text-white">i</span><span>المستندات
                        الداعمة</span><span class="mr-auto text-xs text-slate-500">الحد الأقصى لكل ملف 5MB والصيغ
                        المسموحة PDF, JPG, PNG</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([['label' => 'السجل التجاري', 'type' => 'commercial_registration', 'icon' => 'fa-building-columns'], ['label' => 'الرخصة', 'type' => 'license', 'icon' => 'fa-certificate'], ['label' => 'الهوية', 'type' => 'identity', 'icon' => 'fa-id-card'], ['label' => 'مستندات احتياطية', 'type' => 'other', 'icon' => 'fa-folder-open']] as $document)
                        <label
                            class="group flex min-h-36 cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-slate-300 bg-slate-50 p-4 text-center transition hover:border-slate-600 hover:bg-slate-100"><span
                                class="mb-3 text-3xl text-slate-500 transition group-hover:text-slate-700"><i
                                    class="fa-solid {{ $document['icon'] }}" aria-hidden="true"></i></span><span
                                class="text-sm font-extrabold text-slate-800">{{ $document['label'] }}</span><span
                                class="mt-1 text-xs text-slate-400">اضغط هنا لاختيار الملف المطلوب</span><input
                                type="file" name="attachments[]" accept=".pdf,.jpg,.jpeg,.png"
                                data-type="{{ $document['type'] }}" class="attachment-input sr-only"></label>
                    @endforeach
                </div>
                <div class="mt-6 overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full min-w-155 text-right text-sm">
                        <thead class="bg-slate-100 text-slate-700">
                            <tr>
                                <th class="px-4 py-3">اسم المرفق</th>
                                <th class="px-4 py-3">نوع المستند</th>
                                <th class="px-4 py-3">تاريخ الرفع</th>
                                <th class="px-4 py-3">الحجم</th>
                                <th class="px-4 py-3">الإجراء</th>
                            </tr>
                        </thead>
                        <tbody id="attachmentsTableBody">
                            <tr id="emptyAttachmentsRow">
                                <td colspan="5" class="px-4 py-7 text-center text-slate-500">لا توجد ملفات مرفوعة
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
                <div class="mb-5 flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm text-slate-600">
                    <span
                        class="grid h-5 w-5 place-items-center rounded-full bg-slate-600 text-xs font-bold text-white">i</span><span>تفاصيل
                        العقد المختار وحالة التوقيع الحالية</span>
                </div>
                <div class="grid gap-5 lg:grid-cols-2">
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                        <h2 class="mb-4 font-extrabold text-slate-800">بيانات العميل</h2>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-slate-500">الاسم</dt>
                                <dd>{{ optional($client)->name ?? '—' }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-slate-500">رقم الجوال</dt>
                                <dd>{{ optional($client)->phone ?? '—' }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                        <h2 class="mb-4 font-extrabold text-slate-800">بيانات العقد</h2>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-slate-500">رقم العقد</dt>
                                <dd>{{ App\Models\Contract::generateNextContractNumber() }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-slate-500">تاريخ الإنشاء</dt>
                                <dd>{{ now()->format('Y/m/d') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="mb-2 text-xs text-slate-500">حالة العقد</p><span
                            class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">بانتظار
                            التوقيع</span>
                    </div>
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="mb-2 text-xs text-slate-500">حالة الدفع</p><span
                            class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">لم يتم
                            الدفع</span>
                    </div>
                </div>
                <label class="mt-7 flex cursor-pointer items-center gap-2 text-sm font-bold text-slate-700"><input
                        id="termsAccepted" type="checkbox" required
                        class="h-5 w-5 rounded border-slate-300 text-slate-700 focus:ring-slate-400"><span>أوافق على <a
                            href="#" class="underline">الشروط والأحكام</a> وأقر بصحة البيانات
                        المدخلة</span>
                </label>
                <button type="submit"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-slate-800 px-5 py-3.5 text-sm font-extrabold text-white transition hover:bg-slate-950 sm:w-auto sm:min-w-56">التوقيع
                    الإلكتروني</button>
            </section>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const contractType = document.getElementById('contract_type_id');
            const price = document.getElementById('price');
            const tableBody = document.getElementById('attachmentsTableBody');
            const updateEndDate = () => {
                if (!startDate.value) return;
                const date = new Date(startDate.value + 'T00:00:00');
                date.setFullYear(date.getFullYear() + 1);
                endDate.value = date.toISOString().split('T')[0];
            };
            const updatePrice = () => {
                const option = contractType.options[contractType.selectedIndex];
                price.value = Number(option?.dataset.price || 0).toFixed(2);
            };
            startDate.addEventListener('change', updateEndDate);
            contractType.addEventListener('change', updatePrice);
            updatePrice();
            document.querySelectorAll('.attachment-input').forEach(input => input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                document.getElementById('emptyAttachmentsRow')?.remove();
                input.parentElement.classList.add('border-slate-700', 'bg-slate-100');
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'attachment_types[]';
                hidden.value = input.dataset.type;
                input.parentElement.appendChild(hidden);
                const row = document.createElement('tr');
                row.className = 'border-t border-slate-200';
                row.dataset.type = input.dataset.type;
                row.innerHTML =
                    `<td class="px-4 py-3">${file.name}</td><td class="px-4 py-3">${input.parentElement.querySelector('span:nth-child(2)').textContent}</td><td class="px-4 py-3">${new Date().toLocaleDateString('ar-SA')}</td><td class="px-4 py-3">${(file.size / 1024 / 1024).toFixed(2)} MB</td><td class="px-4 py-3"><button type="button" class="remove-file font-bold text-red-600">حذف</button></td>`;
                tableBody.appendChild(row);
                row.querySelector('.remove-file').addEventListener('click', () => {
                    input.value = '';
                    hidden.remove();
                    row.remove();
                    input.parentElement.classList.remove('border-slate-700', 'bg-slate-100');
                    if (!tableBody.children.length) tableBody.innerHTML =
                        '<tr id="emptyAttachmentsRow"><td colspan="5" class="px-4 py-7 text-center text-slate-500">لا توجد ملفات مرفوعة</td></tr>';
                });
            }));
        });
    </script>
</body>

</html>
