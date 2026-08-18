<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العقود | أمر تم</title>
    <link rel="icon" type="image/png" href="{{ asset('images/new-logo1.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Cairo', sans-serif;
            background: #edf5ef;
            color: #1e293b;
            min-height: 100vh;
        }

        .page-shell {
            max-width: 1240px;
            margin: 30px auto 60px;
            padding: 0 20px;
        }

        .contract-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(15, 61, 36, 0.08);
            margin-bottom: 24px;
            overflow: hidden;
            border: 1px solid rgba(15, 61, 36, 0.06);
        }

        .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid #edf2ef;
            background: linear-gradient(135deg, #f8fbf9 0%, #eef8f1 100%);
        }

        .card-head h5 {
            margin: 0;
            font-weight: 800;
            font-size: 20px;
            color: #0f3d24;
        }

        .card-head p {
            margin: 6px 0 0;
            font-size: 14px;
            color: #6c7a72;
        }

        .info-banner {
            background: #eaf7ee;
            color: #1a5c38;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin: 18px 20px 0;
            border: 1px solid #d5ecdc;
        }

        .party-block {
            padding: 20px;
        }

        .party-table {
            width: 100%;
            border: 1px solid #edf2ef;
            border-radius: 12px;
            overflow: hidden;
            border-collapse: collapse;
        }

        .party-table td {
            padding: 12px 14px;
            font-size: 13px;
            border-bottom: 1px solid #f0f4f2;
        }

        .party-table tr:last-child td {
            border-bottom: none;
        }

        .party-table td.label {
            background: #f9fbfa;
            color: #6c7a72;
            width: 42%;
            font-weight: 700;
        }

        .party-table td.value {
            color: #162b20;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            padding: 18px 20px 22px;
            flex-wrap: wrap;
        }

        .btn-danger-soft,
        .btn-dark-solid,
        .btn-add-contract,
        .btn-submit-contract {
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s ease;
        }

        .btn-danger-soft {
            background: #fdeceb;
            color: #d93025;
            padding: 9px 20px;
        }

        .btn-dark-solid {
            background: #1a5c38;
            color: #fff;
            padding: 10px 22px;
        }

        .btn-add-contract {
            display: block;
            margin: 18px auto;
            background: #1a5c38;
            color: #fff;
            padding: 11px 26px;
        }

        .btn-submit-contract {
            display: block;
            width: 100%;
            background: #1d2d3d;
            color: #fff;
            padding: 14px;
            border-radius: 0 0 14px 14px;
        }

        .empty-box {
            text-align: center;
            color: #6c7a72;
            font-size: 13px;
            padding: 32px 20px;
            background: #fafcfa;
            border-radius: 10px;
            margin: 18px 20px 0;
        }

        .empty-box i {
            display: block;
            font-size: 26px;
            margin-bottom: 10px;
            color: #c4d3c9;
        }

        .contract-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .contract-table thead th {
            background: #f3f7f4;
            color: #6c7a72;
            font-weight: 700;
            padding: 12px 16px;
            text-align: right;
        }

        .contract-table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #edf2ef;
            color: #1f2937;
        }

        .contract-table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-badge.pending {
            background: #fff4d8;
            color: #b7791f;
        }

        .status-badge.active {
            background: #e7f9ee;
            color: #1f8f5f;
        }

        .status-badge.rejected {
            background: #fdeceb;
            color: #d93025;
        }

        .detail-card {
            background: #f9fbfa;
            border-radius: 12px;
            padding: 18px;
            height: 100%;
            border: 1px solid #edf2ef;
        }

        .detail-card .detail-title {
            font-weight: 800;
            font-size: 15px;
            margin-bottom: 12px;
            color: #0f3d24;
        }

        .detail-card table {
            width: 100%;
            font-size: 13px;
        }

        .detail-card table td {
            padding: 7px 0;
            color: #475569;
        }

        .detail-card table td.k {
            color: #6c7a72;
            width: 40%;
            font-weight: 700;
        }

        .footer-status {
            display: flex;
            gap: 16px;
            padding: 0 20px 20px;
        }

        .footer-status .box {
            flex: 1;
            background: #f9fbfa;
            border: 1px solid #edf2ef;
            border-radius: 12px;
            padding: 14px 16px;
        }

        .footer-status .box .t {
            font-size: 12px;
            color: #6c7a72;
            margin-bottom: 8px;
        }

        @media (max-width: 767px) {
            .page-shell {
                padding: 0 14px;
            }

            .footer-status {
                flex-direction: column;
            }
        }

        /* uploading the file */
        .upload-wrapper {
            max-width: 600px;
            margin: 0 auto;
        }

        /* uploading the file */
    </style>
</head>

<body>
    <div class="page-shell">
        <div class="contract-card">
            <div class="card-head">
                <h5>عقد خدمات آمر تم السنوية</h5>
                <p>أكمل جميع الخطوات لإصدار العقد إلكترونياً</p>
            </div>

            <div class="info-banner">
                <i class="fas fa-info-circle" style="margin-left: 8px;"></i>
                يجب إدخال بيانات الطرفين بشكل صحيح
            </div>

            <div class="row g-0"
                style="display:flex; flex-wrap:wrap; flex-direction: column; align-items: center; justify-content: center;">
                <div class="col-md-6" style="width:100%;">
                    <div class="party-block">
                        <table class="party-table">
                            <tr>
                                <td class="label">الطرف الأول</td>
                                <td class="value">
                                    مؤسسة آمر تم لخدمات الأعمال
                                </td>
                            </tr>
                            <tr>
                                <td class="label">رقم السجل التجاري</td>
                                <td class="value">

                                    {{ optional($company)->commercial_registration ?? '—' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">العنوان</td>
                                <td class="value">

                                    {{ optional($company)->address ?? '—' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">البريد الإلكتروني</td>
                                <td class="value">
                                    {{ optional($company)->email ?? '—' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">رقم الجوال</td>
                                <td class="value">
                                    {{ optional($company)->phone ?? '—' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="label">ويمثلها المدير العام</td>
                                <td class="value">
                                    {{ optional($company)->manager_name ?? '—' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6" style="width:100%;">
                    <div class="party-block">
                        <table class="party-table">
                            <tr>
                                <td class="label">الطرف الثاني</td>
                                <td class="value"> <input type="text" class="form-control" placeholder="اسم المنشأة"
                                        aria-label="اسم المنشأة" aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">رقم السجل التجاري</td>
                                <td class="value">
                                    <input type="text" class="form-control" placeholder="رقم السجل التجاري"
                                        aria-label="رقم السجل التجاري" aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">العنوان</td>
                                <td class="value">
                                    <input type="text" class="form-control" placeholder="العنوان"
                                        aria-label="العنوان" aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">البريد الإلكتروني</td>
                                <td class="value">
                                    <input type="email" class="form-control" placeholder="البريد الإلكتروني"
                                        aria-label="البريد الإلكتروني" aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">رقم الجوال</td>
                                <td class="value">
                                    <input type="text" class="form-control" placeholder="رقم الجوال"
                                        aria-label="رقم الجوال" aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">ويمثلها المدير العام</td>
                                <td class="value">
                                    <input placeholder="اسم المدير العام" type="text" class="form-control"
                                        placeholder="اسم المدير العام" aria-label="اسم المدير العام"
                                        aria-describedby="basic-addon1"
                                        style="width: 100%; height: 100%; border: none;">
                                </td>
                            </tr>
                            </tr>
                        </table>
                    </div>

                    <!-- Signature Actions -->
                    <div style="width: 100%; padding: 20px; display: flex; gap: 12px; justify-content: center;">
                        <form method="GET" style="flex: 1; max-width: 300px;">
                            <button type="button" class="btn-dark-solid" style="width: 100%;"
                                onclick="confirmSignature()">
                                <i class="fas fa-check" style="margin-left: 8px;"></i>
                                إقرار البيانات
                            </button>
                        </form>
                        <form method="GET" style="flex: 1; max-width: 300px;">
                            <button type="button" class="btn-dark-solid" style="width: 100%; background: #1a5c38;"
                                onclick="proceedToSignature()">
                                <i class="fas fa-pen-fancy" style="margin-left: 8px;"></i>
                                أكمل للتوقيع
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="contract-card">

            <div class="info-banner">
                <i class="fas fa-info-circle" style="margin-left: 8px;"></i>
                بنود العقد التالية ثابتة ولا يمكن التعديل عليها
            </div>

            <div id="clausesContainer">

                @forelse ($clauses as $clause)
                    <div class="clause-row" style="display:flex; align-items:flex-start; gap:12px; padding:20px;">

                        <label class="input-group-text" style="padding:12px 15px; white-space:nowrap;">
                            البند رقم {{ $loop->iteration }}
                        </label>

                        <div
                            style="
                    flex:1;
                    min-height:70px;
                    border:1px solid #edf2ef;
                    border-radius:10px;
                    padding:12px;
                    background:#f9fbfa;
                    color:#1f2937;
                    line-height:1.7;
                ">
                            {{ $clause->content }}
                        </div>

                        {{-- حقل مخفي عشان نرسل رقم البند مع الفورم عند حفظ العقد --}}
                        <input type="hidden" name="clause_ids[]" value="{{ $clause->id }}">

                    </div>
                @empty
                    <div class="empty-box">
                        <i class="fas fa-file-alt"></i>
                        لا توجد بنود مضافة حالياً
                    </div>
                @endforelse

            </div>

        </div>

        <div class="contract-card">

            <div class="info-banner">
                <i class="fas fa-info-circle" style="margin-left: 8px;"></i>
                تفاصيل العقد
            </div>

            <form action="{{ route('contracts.store') }}" method="POST" style="padding: 20px;">
                @csrf

                <div class="row g-3" style="display: flex; flex-wrap: wrap; gap: 16px;">
                    <div style="flex: 1; min-width: 220px;">
                        <label for="contract_number"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">رقم العقد</label>
                        <input type="text" id="contract_number" name="contract_number" class="form-control"
                            value="{{ App\Models\Contract::generateNextContractNumber() }}" readonly
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px; background:#f8fbf9;">
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="start_date"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">تاريخ بداية
                            العقد</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ $defaultStartDate ?? now()->toDateString() }}"
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px;">
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="end_date"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">تاريخ نهاية
                            العقد</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ $defaultEndDate ?? now()->addYear()->toDateString() }}"
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px;">
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="duration_years"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">مدة العقد</label>
                        <input type="number" id="duration_years" name="duration_years" min="1"
                            value="1" readonly
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px; background:#f8fbf9;">
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="contract_type_id"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">نوع العقد</label>
                        <select id="contract_type_id" name="contract_type_id" class="form-control"
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px; background:#fff;">
                            @foreach ($contractTypes ?? [] as $type)
                                <option value="{{ $type->id }}" data-price="{{ $type->price }}">
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="flex: 1; min-width: 220px;">
                        <label for="price"
                            style="display:block; margin-bottom:8px; font-weight:700; color:#0f3d24;">السعر</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" readonly
                            value="{{ optional(($contractTypes ?? collect())->first())->price ?? 0 }}"
                            style="width:100%; border:1px solid #dfeae4; border-radius:10px; padding:10px 12px; background:#f8fbf9;">
                    </div>
                </div>

            </form>

        </div>


        <div class="contract-card">
            <div class="info-banner">
                <i class="fas fa-info-circle" style="margin-left: 8px;"></i>
                يمكنك رفع المستندات الداعمة للعقد. الحد الأقصى لحجم الملف 5MB، والصيغ المسموحة (PDF, JPG, PNG)
            </div>
            <div class="upload-wrapper" style="display: flex; justify-content:center; align-items:center;">

                <div class="upload-box" id="uploadBox">
                    <div class="upload-icon-wrap">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <div class="upload-title">
                        <span class="highlight">اضغط هنا</span> لرفع مرفق جديد أو اسحب الملف وأفلته
                    </div>
                    <div class="upload-subtitle">
                        PDF, JPG, PNG — لكل ملف حتى 5MB
                    </div>
                    <input type="file" id="fileInput" accept=".pdf,.jpg,.jpeg,.png" multiple>
                </div>

                <div class="error-msg" id="errorMsg"></div>

                <div id="previewList"></div>

            </div>

            <table class="table" style="width: 100%; padding: 20px;">
                <thead>
                    <tr>
                        <th scope="col">اسم المرفق</th>
                        <th scope="col">نوع المرفق</th>
                        <th scope="col">تاريخ الرفع</th>
                        <th scope="col">الحجم</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                </thead>

                <tbody id="attachmentsTableBody">

                    <tr id="emptyAttachmentsRow">
                        <td colspan="5" style="text-align:center; padding:30px; color:#6c7a72;">
                            لا توجد ملفات مرفوعة
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>


        <div class="contract-card">
            <div class="info-banner">
                <i class="fas fa-info-circle" style="margin-left: 8px;"></i>
                تفاصيل العقد المختار وحالة التوقيع الحالية.
            </div>

            <div class="row g-3" style="display:flex; flex-wrap:wrap; padding:0 20px 20px; gap:16px;">
                <div class="col-md-6" style="flex:1; min-width:260px;">
                    <div class="detail-card">
                        <div class="detail-title">بيانات العميل</div>
                        <table>
                            <tr>
                                <td class="k">الاسم</td>
                                <td>{{ optional($contract)->client_name ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="k">رقم الجوال</td>
                                <td>{{ optional($contract)->client_phone ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="k">رقم الجوال الإضافي</td>
                                <td>{{ optional($contract)->client_alt_phone ?? '—' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6" style="flex:1; min-width:260px;">
                    <div class="detail-card">
                        <div class="detail-title">بيانات العقد</div>
                        <table>
                            <tr>
                                <td class="k">رقم العقد</td>
                                <td>{{ optional($contract)->contract_number ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="k">تاريخ الإنشاء</td>
                                <td>{{ optional(optional($contract)->created_at)->format('Y/m/d') ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="k">الحالة</td>
                                <td>
                                    <span
                                        class="status-badge pending">{{ optional($contract)->status_label ?? 'قيد الانتظار' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="footer-status">
                <div class="box">
                    <div class="t">حالة العقد</div>
                    <span
                        class="status-badge pending">{{ optional($contract)->status_label ?? 'قيد الانتظار' }}</span>
                </div>
                <div class="box">
                    <div class="t">حالة التوقيع</div>
                    <span
                        class="status-badge pending">{{ optional($contract)->signature_status_label ?? 'بانتظار التوقيع' }}</span>
                </div>
            </div>

            @if (optional($contract)->exists ?? false)
                <form action="{{ route('contract.submit', $contract->id ?? 0) }}" method="POST"
                    style="padding:0 20px 20px;">
                    @csrf
                    <button type="submit" class="btn-submit-contract">
                        حفظ وإرسال العقد
                    </button>
                </form>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const contractTypeSelect = document.getElementById('contract_type_id');
            const priceInput = document.getElementById('price');

            function setContractPrice() {
                const selectedOption = contractTypeSelect.options[contractTypeSelect.selectedIndex];
                const selectedPrice = selectedOption ? Number(selectedOption.dataset.price || 0) : 0;
                priceInput.value = selectedPrice.toFixed(2);
            }

            function setEndDateFromStart() {
                if (!startDateInput.value) {
                    return;
                }

                const startDate = new Date(startDateInput.value + 'T00:00:00');
                const nextYear = new Date(startDate);
                nextYear.setFullYear(startDate.getFullYear() + 1);

                const formatted = nextYear.toISOString().split('T')[0];
                endDateInput.value = formatted;
            }

            if (startDateInput && endDateInput) {
                startDateInput.addEventListener('change', setEndDateFromStart);
                setEndDateFromStart();
            }

            if (contractTypeSelect && priceInput) {
                contractTypeSelect.addEventListener('change', setContractPrice);
                setContractPrice();
            }

            console.log('Contract JS Loaded');


            // ==========================================
            // البنود
            // ==========================================

            const addButton = document.getElementById('addClauseBtn');

            const clausesContainer =
                document.getElementById('clausesContainer');


            // زر إضافة بند
            addButton.addEventListener('click', function() {

                console.log('تم الضغط على إضافة بند');


                const clauseNumber =
                    clausesContainer.querySelectorAll('.clause-row').length + 1;


                const newClause =
                    document.createElement('div');


                newClause.className = 'clause-row';


                newClause.style.cssText = `
            display:flex;
            align-items:center;
            gap:12px;
            padding:20px;
        `;


                newClause.innerHTML = `

            <label
                class="input-group-text"
                style="
                    padding:12px 15px;
                    white-space:nowrap;
                "
            >
                البند رقم ${clauseNumber}
            </label>


            <textarea
                name="clauses[]"
                placeholder="نص البند"
                style="
                    flex:1;
                    min-height:70px;
                    border:1px solid #edf2ef;
                    border-radius:10px;
                    padding:12px;
                    resize:vertical;
                "
            ></textarea>


            <button
                type="button"
                class="btn-danger-soft delete-clause"
            >
                حذف
            </button>

        `;


                clausesContainer.appendChild(newClause);

            });



            // ==========================================
            // حذف البند
            // ==========================================

            clausesContainer.addEventListener('click', function(event) {

                const deleteButton =
                    event.target.closest('.delete-clause');


                if (!deleteButton) {
                    return;
                }


                const clause =
                    deleteButton.closest('.clause-row');


                if (clause) {

                    clause.remove();

                    updateClauseNumbers();

                }

            });



            // ==========================================
            // إعادة ترقيم البنود
            // ==========================================

            function updateClauseNumbers() {

                const clauses =
                    clausesContainer.querySelectorAll('.clause-row');


                clauses.forEach(function(clause, index) {

                    const label =
                        clause.querySelector('label');


                    label.textContent =
                        'البند رقم ' + (index + 1);

                });

            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const fileInput = document.getElementById('fileInput');
            const tableBody = document.getElementById('attachmentsTableBody');

            fileInput.addEventListener('change', function() {

                const files = Array.from(this.files);

                files.forEach(function(file) {

                    // إزالة رسالة "لا توجد ملفات"
                    const emptyRow =
                        document.getElementById('emptyAttachmentsRow');

                    if (emptyRow) {
                        emptyRow.remove();
                    }

                    // إنشاء صف جديد
                    const row = document.createElement('tr');

                    row.innerHTML = `
                <td style="text-align:center;">
                    ${file.name}
                </td>

                <td style="text-align:center;">
                    ${getFileType(file)}
                </td>

                <td style="text-align:center;">
                    ${formatDate(new Date())}
                </td>

                <td style="text-align:center;">
                    ${formatFileSize(file.size)}
                </td>

                <td style="text-align:center;">

                    <button type="button" class="preview-file">
                        <i class="bi bi-eye"></i>
                    </button>

                    <button type="button" class="delete-file">
                        <i class="bi bi-trash"></i>
                    </button>

                </td>
            `;

                    // نخزن الملف داخل الصف
                    row.file = file;

                    tableBody.appendChild(row);

                });

                // تصفير input
                this.value = '';

            });


            // نوع الملف
            function getFileType(file) {

                if (file.type === 'application/pdf') {
                    return 'PDF';
                }

                if (file.type === 'image/jpeg') {
                    return 'JPG';
                }

                if (file.type === 'image/png') {
                    return 'PNG';
                }

                return 'ملف';
            }


            // حجم الملف
            function formatFileSize(bytes) {

                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(1) + ' KB';
                }

                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            }


            // التاريخ
            function formatDate(date) {

                const day =
                    String(date.getDate()).padStart(2, '0');

                const month =
                    String(date.getMonth() + 1).padStart(2, '0');

                const year =
                    date.getFullYear();

                return `${day}/${month}/${year}`;
            }


            // حذف الملف من الجدول
            tableBody.addEventListener('click', function(event) {

                const deleteButton =
                    event.target.closest('.delete-file');

                if (!deleteButton) {
                    return;
                }

                const row =
                    deleteButton.closest('tr');

                row.remove();

            });


            // معاينة الملف
            tableBody.addEventListener('click', function(event) {

                const previewButton =
                    event.target.closest('.preview-file');

                if (!previewButton) {
                    return;
                }

                const row =
                    previewButton.closest('tr');

                if (!row.file) {
                    return;
                }

                const url =
                    URL.createObjectURL(row.file);

                window.open(url, '_blank');

            });

        });
    </script>

    <script>
        /**
         * Validate second party data
         */
        function validateSecondPartyData() {
            const inputs = document.querySelectorAll('.party-block:last-of-type input');
            const errors = [];

            // Get input values
            const data = {
                name: inputs[0]?.value?.trim() || '',
                commercial_registration: inputs[1]?.value?.trim() || '',
                address: inputs[2]?.value?.trim() || '',
                email: inputs[3]?.value?.trim() || '',
                phone: inputs[4]?.value?.trim() || '',
                manager_name: inputs[5]?.value?.trim() || ''
            };

            // Type checking
            if (typeof data.name !== 'string' || data.name.length < 3) {
                errors.push('اسم المنشأة يجب أن يكون 3 أحرف على الأقل');
            }

            if (typeof data.commercial_registration !== 'string' || data.commercial_registration.length < 5) {
                errors.push('رقم السجل التجاري يجب أن يكون 5 أرقام على الأقل');
            }

            if (typeof data.address !== 'string' || data.address.length < 5) {
                errors.push('العنوان يجب أن يكون 5 أحرف على الأقل');
            }

            if (typeof data.email !== 'string' || !isValidEmail(data.email)) {
                errors.push('البريد الإلكتروني غير صحيح');
            }

            if (typeof data.phone !== 'string' || !isValidPhone(data.phone)) {
                errors.push('رقم الجوال غير صحيح (يجب أن يكون 9 أرقام على الأقل)');
            }

            if (typeof data.manager_name !== 'string' || data.manager_name.length < 3) {
                errors.push('اسم المدير العام يجب أن يكون 3 أحرف على الأقل');
            }

            return {
                valid: errors.length === 0,
                errors: errors,
                data: data
            };
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            const phoneRegex = /^\d{9,}$/;
            return phoneRegex.test(phone.replace(/\D/g, ''));
        }

        function showErrorAlert(errors) {
            const errorList = errors.join('\n');
            alert('الرجاء تصحيح الأخطاء:\n\n' + errorList);
        }

        function confirmSignature() {
            const validation = validateSecondPartyData();

            if (!validation.valid) {
                showErrorAlert(validation.errors);
                return;
            }

            // Store data in session/localStorage for later use
            sessionStorage.setItem('secondPartyData', JSON.stringify(validation.data));
            alert('تم إقرار البيانات بنجاح!');
        }

        function proceedToSignature() {
            const validation = validateSecondPartyData();

            if (!validation.valid) {
                showErrorAlert(validation.errors);
                return;
            }

            // Store data in session/localStorage
            sessionStorage.setItem('secondPartyData', JSON.stringify(validation.data));

            // Show loading state
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-left: 8px;"></i>جاري المتابعة...';
            btn.disabled = true;

            // Make API call to create client and get verification URL
            fetch('/clients', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify(validation.data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.client_id) {
                        // Redirect to signature verification page
                        window.location.href = `/client/${data.client_id}/signature-verification`;
                    } else {
                        throw new Error(data.message || 'فشل إنشاء بيانات العميل');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert([error.message || 'حدث خطأ أثناء المعالجة']);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                });
        }
    </script>

</body>

</html>
