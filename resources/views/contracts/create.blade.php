<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء عقد | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-emerald-50/40 font-sans text-emerald-950">
    <main class="mx-auto w-full max-w-7xl space-y-5 px-4 py-5 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="rounded-xl border border-emerald-300 bg-emerald-100 px-5 py-4 text-sm font-bold text-emerald-900 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800 shadow-sm">
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

            <!-- Header & Contract Details Section -->
            <section class="overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">
                <header
                    class="border-b border-emerald-100 bg-gradient-to-br from-white via-emerald-50/30 to-emerald-100/30 px-4 py-4 sm:px-6 sm:py-5">
                    <div class="flex flex-col-reverse items-center justify-between gap-4 md:flex-row">
                        <!-- Logo -->
                        <div class="flex h-16 w-36 shrink-0 items-center justify-center sm:h-20 sm:w-48">
                            <img class="h-full w-full object-contain" src="{{ asset('images/new-logo1.png') }}"
                                alt="أمر تم">
                        </div>

                        <!-- Contract Details Box -->
                        <div
                            class="flex flex-wrap items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50/60 p-2.5 shadow-sm sm:gap-2.5 sm:p-3">

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">نوع العقد</span>
                                <select id="contract_type_id" name="contract_type_id" required
                                    class="w-24 sm:w-28 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400">
                                    @foreach ($contractTypes ?? [] as $type)
                                        <option value="{{ $type->id }}" data-price="{{ $type->price }}">
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">المدة (السنوات)</span>
                                <input id="duration_years" name="duration_years" type="number" value="1"
                                    min="1" readonly
                                    class="w-16 sm:w-20 rounded-lg border border-emerald-200 bg-emerald-100/70 px-2 py-1.5 text-center text-xs font-extrabold text-emerald-900 outline-none">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">بداية العقد</span>
                                <input id="start_date" name="start_date" type="date"
                                    value="{{ $defaultStartDate ?? now()->toDateString() }}" required
                                    class="w-32 sm:w-34 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">نهاية العقد</span>
                                <input id="end_date" name="end_date" type="date"
                                    value="{{ $defaultEndDate ?? now()->addYear()->toDateString() }}" required
                                    class="w-32 sm:w-34 rounded-lg border border-emerald-200 bg-white px-2 py-1.5 text-xs font-semibold text-emerald-950 outline-none transition focus:border-emerald-500 focus:ring-1 focus:ring-emerald-400">
                            </div>

                            <div class="flex flex-col gap-1">
                                <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">رقم العقد</span>
                                <input id="contract_number" type="text"
                                    value="{{ App\Models\Contract::generateNextContractNumber() }}" readonly
                                    class="w-28 sm:w-32 rounded-lg border border-emerald-200 bg-emerald-100/70 px-2 py-1.5 text-center text-xs font-extrabold text-emerald-900 outline-none">
                            </div>

                        </div>

                    </div>
                </header>
            </section>

            <!-- Contract Main Banner & Parties Section -->
            <section class="overflow-hidden rounded-2xl border border-emerald-200 bg-white shadow-sm">
                <header
                    class="flex items-center justify-center border-b border-emerald-900 bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-800 px-5 py-4 sm:px-7">
                    <div>
                        <h2 class="text-xl font-extrabold text-white">عقد <span id="contract_type_display">{{ optional(($contractTypes ?? collect())->first())->name ?? 'سنوي' }}</span> إلكتروني</h2>
                    </div>
                </header>

                <div class="bg-emerald-50/50 p-5 sm:p-7">
                    <div class="grid gap-5 lg:grid-cols-2">
                        @foreach ([['title' => 'الطرف الأول', 'data' => $company], ['title' => 'الطرف الثاني', 'data' => $client]] as $party)
                            <div class="overflow-hidden rounded-xl border border-emerald-200 bg-white shadow-sm">
                                <div
                                    class="flex items-center justify-center border-b border-emerald-900 bg-gradient-to-r from-emerald-900 to-emerald-800 px-5 py-3.5">
                                    <h3 class="text-base font-extrabold text-white">{{ $party['title'] }}</h3>
                                </div>
                                <dl class="divide-y divide-emerald-100 text-sm">
                                    @foreach ([['label' => 'اسم المنشأة', 'value' => optional($party['data'])->name ?? ($party['title'] === 'الطرف الأول' ? 'مؤسسة آمر تم لخدمات الأعمال' : '—')], ['label' => 'الرقم الوطني الموحد', 'value' => optional($party['data'])->commercial_registration ?? '—'], ['label' => 'العنوان', 'value' => optional($party['data'])->address ?? '—'], ['label' => 'البريد الإلكتروني', 'value' => optional($party['data'])->email ?? '—'], ['label' => 'رقم الجوال', 'value' => optional($party['data'])->phone ?? '—'], ['label' => 'ويمثلها المدير العام', 'value' => optional($party['data'])->manager_name ?? '—']] as $item)
                                        <div class="grid grid-cols-3 gap-3 px-4 py-3.5 sm:px-5">
                                            <dt class="font-bold text-emerald-700">{{ $item['label'] }}</dt>
                                            <dd class="col-span-2 wrap-break-word font-semibold text-emerald-950">
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

            <!-- Clauses Section -->
            <section class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-7">
                <div id="clausesContainer" class="space-y-3">
                    @php
                        $firstClause = $contractTerms->firstWhere('contract_term_name', 'التمهيد');
                        $otherClauses = $contractTerms->where('contract_term_name', '!=', 'التمهيد');
                    @endphp

                    @if ($firstClause)
                        <article class="flex rounded-xl p-2">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-2xl font-black leading-tight text-emerald-950">
                                    {{ $firstClause->contract_term_name }}
                                </h2>

                                <p class="mt-2 whitespace-pre-line text-sm leading-7 text-emerald-800">
                                    {{ $firstClause->contract_term_description }}
                                </p>
                            </div>
                        </article>
                    @endif

                    @forelse ($otherClauses ?? collect() as $clause)
                        <article
                            class="flex gap-4 rounded-xl border border-emerald-200 border-r-4 border-r-emerald-700 bg-emerald-50/50 p-4 sm:p-5 transition hover:bg-emerald-100/50">
                            <span
                                class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-emerald-100 text-sm font-black text-emerald-900 shadow-sm">{{ $loop->iteration }}</span>
                            <div class="min-w-0 flex-1">
                                <h2 class="mb-2 text-lg font-extrabold text-emerald-900">
                                    {{ $clause->contract_term_name }}</h2>
                                <p class="whitespace-pre-line text-sm leading-7 text-emerald-800">
                                    {{ $clause->contract_term_description }}</p>
                            </div>
                            <input type="hidden" name="clause_ids[]" value="{{ $clause->id }}">
                        </article>
                    @empty
                        <p class="rounded-xl bg-emerald-50/50 p-8 text-center text-sm font-bold text-emerald-700">
                            لا توجد بنود مضافة حالياً
                        </p>
                    @endforelse

                    <article
                        class="flex gap-4 rounded-xl border border-emerald-200 border-r-4 border-r-emerald-700 bg-emerald-50/50 p-4 sm:p-5 transition hover:bg-emerald-100/50">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <h2 class="obligation-label text-lg font-extrabold text-emerald-900">
                                    بند الإلتزامات المالية
                                </h2>
                                <div class="obligation-type inline-flex items-center rounded-lg bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">
                                    حق عقود
                                </div>
                            </div>
                            
                            <div class="obligation-amount-box flex items-center justify-between rounded-xl border border-emerald-300 bg-emerald-100/70 px-4 py-3 sm:px-5 sm:py-3.5">
                                <span class="amount-label text-sm font-bold text-emerald-800">المبلغ المستحق:</span>
                                <div class="flex items-baseline gap-1.5">
                                    <span class="amount-value text-xl font-black text-emerald-950">
                                        {{ number_format(optional(($contractTypes ?? collect())->first())->price ?? 0, 2) }}
                                    </span>
                                    <span class="currency text-xs font-bold text-emerald-700">ر.س</span>
                                </div>
                            </div>

                            <input id="price" name="price" type="hidden"
                                value="{{ optional(($contractTypes ?? collect())->first())->price ?? 0 }}">
                        </div>
                    </article>
                </div>
            </section>

            <!-- Attachments Section -->
            <section class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-7">
                <div
                    class="mb-5 flex flex-wrap items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-100/70 px-4 py-3 text-sm font-bold text-emerald-900">
                    <span
                        class="grid h-5 w-5 place-items-center rounded-full bg-emerald-700 text-xs font-bold text-white">i</span>
                    <span>المستندات الداعمة</span>
                    <span class="mr-auto text-xs font-semibold text-emerald-700">الحد الأقصى لكل ملف 5MB والصيغ المسموحة PDF, JPG, PNG</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([['label' => 'السجل التجاري', 'type' => 'commercial_registration', 'icon' => 'fa-building-columns'], ['label' => 'الرخصة', 'type' => 'license', 'icon' => 'fa-certificate'], ['label' => 'الهوية', 'type' => 'identity', 'icon' => 'fa-id-card'], ['label' => 'مستندات احتياطية', 'type' => 'other', 'icon' => 'fa-folder-open']] as $document)
                        <label
                            class="group flex min-h-36 cursor-pointer flex-col items-center justify-center rounded-xl border border-dashed border-emerald-300 bg-emerald-50/50 p-4 text-center transition hover:border-emerald-700 hover:bg-emerald-100/50">
                            <span
                                class="mb-3 text-3xl text-emerald-600 transition group-hover:text-emerald-900 group-hover:scale-110">
                                <i class="fa-solid {{ $document['icon'] }}" aria-hidden="true"></i>
                            </span>
                            <span class="text-sm font-extrabold text-emerald-900">{{ $document['label'] }}</span>
                            <span class="mt-1 text-xs font-semibold text-emerald-600">اضغط هنا لاختيار الملف المطلوب</span>
                            <input type="file" name="attachments[]" accept=".pdf,.jpg,.jpeg,.png"
                                data-type="{{ $document['type'] }}" class="attachment-input sr-only">
                        </label>
                    @endforeach
                </div>
                <div class="mt-6 overflow-x-auto rounded-xl border border-emerald-200">
                    <table class="w-full min-w-155 text-right text-sm">
                        <thead class="bg-emerald-100 text-emerald-900">
                            <tr>
                                <th class="px-4 py-3 font-extrabold">اسم المرفق</th>
                                <th class="px-4 py-3 font-extrabold">نوع المستند</th>
                                <th class="px-4 py-3 font-extrabold">تاريخ الرفع</th>
                                <th class="px-4 py-3 font-extrabold">الحجم</th>
                                <th class="px-4 py-3 font-extrabold">الإجراء</th>
                            </tr>
                        </thead>
                        <tbody id="attachmentsTableBody">
                            <tr id="emptyAttachmentsRow">
                                <td colspan="5" class="px-4 py-7 text-center font-semibold text-emerald-600">
                                    لا توجد ملفات مرفوعة
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Summary & Signature Section -->
            <section class="rounded-2xl border border-emerald-200 bg-white p-5 shadow-sm sm:p-7">
                <div class="mb-5 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-100/70 px-4 py-3 text-sm font-bold text-emerald-900">
                    <span
                        class="grid h-5 w-5 place-items-center rounded-full bg-emerald-700 text-xs font-bold text-white">i</span>
                    <span>تفاصيل العقد المختار وحالة التوقيع الحالية</span>
                </div>
                <div class="grid gap-5 lg:grid-cols-2">
                    <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                        <h2 class="mb-4 font-extrabold text-emerald-900">بيانات العميل</h2>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-emerald-700">الاسم</dt>
                                <dd class="font-semibold text-emerald-950">{{ optional($client)->name ?? '—' }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-emerald-700">رقم الجوال</dt>
                                <dd class="font-semibold text-emerald-950">{{ optional($client)->phone ?? '—' }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 p-5 shadow-sm">
                        <h2 class="mb-4 font-extrabold text-emerald-900">بيانات العقد</h2>
                        <dl class="space-y-3 text-sm">
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-emerald-700">رقم العقد</dt>
                                <dd class="font-semibold text-emerald-950">{{ App\Models\Contract::generateNextContractNumber() }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="font-bold text-emerald-700">تاريخ الإنشاء</dt>
                                <dd class="font-semibold text-emerald-950">{{ now()->format('Y/m/d') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-emerald-200 bg-white p-4">
                        <p class="mb-2 text-xs font-bold text-emerald-700">حالة العقد</p>
                        <span
                            class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-900">بانتظار
                            التوقيع</span>
                    </div>
                    <div class="rounded-xl border border-emerald-200 bg-white p-4">
                        <p class="mb-2 text-xs font-bold text-emerald-700">حالة الدفع</p>
                        <span
                            class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-900">لم يتم
                            الدفع</span>
                    </div>
                </div>
                <label class="mt-7 flex cursor-pointer items-center gap-2.5 text-sm font-bold text-emerald-900">
                    <input id="termsAccepted" type="checkbox" required
                        class="h-5 w-5 rounded border-emerald-300 text-emerald-700 focus:ring-emerald-500 accent-emerald-700">
                    <span>أوافق على <a href="#" class="text-emerald-700 underline hover:text-emerald-950">الشروط والأحكام</a> وأقر بصحة البيانات المدخلة</span>
                </label>
                <button type="submit"
                    class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-emerald-900 px-5 py-3.5 text-base font-extrabold text-white shadow-lg shadow-emerald-900/20 transition-all hover:bg-emerald-950 hover:shadow-xl sm:w-auto sm:min-w-56">
                    التوقيع الإلكتروني
                </button>
            </section>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const contractType = document.getElementById('contract_type_id');
            const contractTypeDisplay = document.getElementById('contract_type_display');
            const price = document.getElementById('price');
            const tableBody = document.getElementById('attachmentsTableBody');
            const updateEndDate = () => {
                if (!startDate.value) return;
                const date = new Date(startDate.value + 'T00:00:00');
                date.setFullYear(date.getFullYear() + 1);
                endDate.value = date.toISOString().split('T')[0];
            };
            const amountValueDisplay = document.querySelector('.amount-value');
            const updateContractType = () => {
                const option = contractType.options[contractType.selectedIndex];
                const rawPrice = Number(option?.dataset.price || 0);
                if (price) {
                    price.value = rawPrice.toFixed(2);
                }
                if (amountValueDisplay) {
                    amountValueDisplay.textContent = rawPrice.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
                if (contractTypeDisplay && option) {
                    contractTypeDisplay.textContent = option.text.trim();
                }
            };
            startDate.addEventListener('change', updateEndDate);
            contractType.addEventListener('change', updateContractType);
            updateContractType();
            document.querySelectorAll('.attachment-input').forEach(input => input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;
                document.getElementById('emptyAttachmentsRow')?.remove();
                input.parentElement.classList.add('border-emerald-700', 'bg-emerald-100/60');
                const hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'attachment_types[]';
                hidden.value = input.dataset.type;
                input.parentElement.appendChild(hidden);
                const row = document.createElement('tr');
                row.className = 'border-t border-emerald-200 bg-white';
                row.dataset.type = input.dataset.type;
                row.innerHTML =
                    `<td class="px-4 py-3 font-semibold text-emerald-950">${file.name}</td><td class="px-4 py-3 text-emerald-700">${input.parentElement.querySelector('span:nth-child(2)').textContent}</td><td class="px-4 py-3 text-emerald-600">${new Date().toLocaleDateString('ar-SA')}</td><td class="px-4 py-3 font-bold text-emerald-900">${(file.size / 1024 / 1024).toFixed(2)} MB</td><td class="px-4 py-3"><button type="button" class="remove-file font-bold text-red-600 hover:text-red-800 transition">حذف</button></td>`;
                tableBody.appendChild(row);
                row.querySelector('.remove-file').addEventListener('click', () => {
                    input.value = '';
                    hidden.remove();
                    row.remove();
                    input.parentElement.classList.remove('border-emerald-700', 'bg-emerald-100/60');
                    if (!tableBody.children.length) tableBody.innerHTML =
                        '<tr id="emptyAttachmentsRow"><td colspan="5" class="px-4 py-7 text-center font-semibold text-emerald-600">لا توجد ملفات مرفوعة</td></tr>';
                });
            }));
        });
    </script>
</body>

</html>
