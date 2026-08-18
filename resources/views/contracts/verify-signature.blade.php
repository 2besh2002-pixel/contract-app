<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>توثيق التوقيع | أمر تم</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verification-container {
            width: 100%;
            max-width: 500px;
        }

        .verification-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(15, 61, 36, 0.08);
            overflow: hidden;
            border: 1px solid rgba(15, 61, 36, 0.06);
        }

        .card-head {
            padding: 28px 24px;
            border-bottom: 1px solid #edf2ef;
            background: linear-gradient(135deg, #f8fbf9 0%, #eef8f1 100%);
            text-align: center;
        }

        .card-head h5 {
            margin: 0;
            font-weight: 800;
            font-size: 22px;
            color: #0f3d24;
        }

        .card-head p {
            margin: 10px 0 0;
            font-size: 14px;
            color: #6c7a72;
        }

        .card-body {
            padding: 28px 24px;
        }

        .info-banner {
            background: #eaf7ee;
            color: #1a5c38;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #d5ecdc;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-banner i {
            flex-shrink: 0;
        }

        .party-info {
            background: #f9fbfa;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .party-info .label {
            font-size: 12px;
            color: #6c7a72;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .party-info .value {
            font-size: 15px;
            color: #0f3d24;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #0f3d24;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            border: 1px solid #dfeae4;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
            color: #162b20;
            background: #fff;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26, 92, 56, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 60px;
        }

        .otp-input-wrapper {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .otp-input-wrapper input {
            flex: 1;
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            border: 2px solid #dfeae4;
            border-radius: 10px;
            padding: 0;
        }

        .otp-input-wrapper input:focus {
            border-color: #1a5c38;
            box-shadow: 0 0 0 3px rgba(26, 92, 56, 0.1);
        }

        .timer {
            text-align: center;
            font-size: 13px;
            color: #6c7a72;
            margin-bottom: 16px;
        }

        .timer.expired {
            color: #d93025;
        }

        .timer strong {
            font-weight: 700;
        }

        .resend-link {
            text-align: center;
            margin-bottom: 20px;
        }

        .resend-link a {
            color: #1a5c38;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
        }

        .resend-link a:hover {
            text-decoration: underline;
        }

        .resend-link a.disabled {
            color: #c4d3c9;
            cursor: not-allowed;
            pointer-events: none;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-secondary,
        .btn-primary {
            flex: 1;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            padding: 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-family: 'Cairo', sans-serif;
        }

        .btn-secondary {
            background: #f3f7f4;
            color: #1a5c38;
            border: 1px solid #dfeae4;
        }

        .btn-secondary:hover {
            background: #eef8f1;
        }

        .btn-primary {
            background: #1a5c38;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0f3d24;
        }

        .btn-primary:disabled {
            background: #c4d3c9;
            cursor: not-allowed;
        }

        .error-message {
            background: #fdeceb;
            color: #d93025;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
            border: 1px solid #f8d7da;
            display: none;
        }

        .error-message.show {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success-message {
            background: #e7f9ee;
            color: #1f8f5f;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 16px;
            border: 1px solid #d5ecdc;
            display: none;
        }

        .success-message.show {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .loading-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 480px) {
            .card-body {
                padding: 20px 16px;
            }

            .otp-input-wrapper input {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="verification-container">
        <div class="verification-card">
            <div class="card-head">
                <h5>توثيق التوقيع</h5>
                <p>أدخل رمز التحقق المرسل إلى هاتفك</p>
            </div>

            <div class="card-body">
                <div class="info-banner">
                    <i class="fas fa-info-circle"></i>
                    <span>تم إرسال رمز التحقق إلى {{ maskPhone($client->phone ?? '') }}</span>
                </div>

                <div class="party-info">
                    <div class="label">الطرف الثاني</div>
                    <div class="value">{{ $client->name ?? 'غير محدد' }}</div>
                </div>

                <div class="error-message" id="errorMessage">
                    <i class="fas fa-exclamation-circle"></i>
                    <span id="errorText"></span>
                </div>

                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>تم التحقق بنجاح! جاري تحديث البيانات...</span>
                </div>

                <form id="verificationForm" method="POST" action="{{ route('client.verify-otp', $client->id ?? 0) }}">
                    @csrf

                    <div class="form-group">
                        <label for="otp">رمز التحقق</label>
                        <div class="otp-input-wrapper" id="otpInputWrapper">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                            <input type="text" class="otp-input" maxlength="1" inputmode="numeric"
                                autocomplete="off">
                        </div>
                        <input type="hidden" id="otpCode" name="otp_code">
                    </div>

                    <div class="timer" id="timer">
                        سينتهي الكود خلال <strong id="timerValue">10:00</strong>
                    </div>

                    <div class="resend-link">
                        <a href="javascript:void(0);" id="resendLink" class="disabled">إعادة إرسال الرمز</a>
                    </div>

                    <div class="action-buttons">
                        <a href="{{ route('contracts.create') }}" class="btn-secondary">
                            <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                            العودة
                        </a>
                        <button type="submit" class="btn-primary" id="submitBtn">
                            <span id="btnText">تحقق الآن</span>
                            <span class="loading-spinner" id="btnSpinner"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const otpCodeInput = document.getElementById('otpCode');
            const verificationForm = document.getElementById('verificationForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            const successMessage = document.getElementById('successMessage');
            const timerElement = document.getElementById('timer');
            const timerValue = document.getElementById('timerValue');
            const resendLink = document.getElementById('resendLink');

            let timerInterval = null;
            let timeRemaining = 600; // 10 minutes in seconds

            // Timer function
            function startTimer() {
                timeRemaining = 600;
                resendLink.classList.add('disabled');

                if (timerInterval) clearInterval(timerInterval);

                timerInterval = setInterval(() => {
                    timeRemaining--;

                    const minutes = Math.floor(timeRemaining / 60);
                    const seconds = timeRemaining % 60;
                    timerValue.textContent = `${minutes}:${String(seconds).padStart(2, '0')}`;

                    if (timeRemaining <= 0) {
                        clearInterval(timerInterval);
                        timerElement.classList.add('expired');
                        timerValue.textContent = '0:00';
                        resendLink.classList.remove('disabled');
                    } else if (timeRemaining <= 60) {
                        timerElement.classList.add('expired');
                    }
                }, 1000);
            }

            // OTP Input handling
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    // Only allow numbers
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');

                    // Move to next input
                    if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    // Update hidden input
                    updateOTPCode();

                    // Auto-submit if all fields are filled
                    if (isOTPComplete()) {
                        // Optional: auto-submit after a short delay
                        setTimeout(() => {
                            if (isOTPComplete()) {
                                submitBtn.click();
                            }
                        }, 300);
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = (e.clipboardData || window.clipboardData).getData('text');
                    const digits = pastedData.replace(/[^0-9]/g, '').split('');

                    digits.forEach((digit, i) => {
                        if (i < otpInputs.length) {
                            otpInputs[i].value = digit;
                        }
                    });

                    updateOTPCode();

                    if (isOTPComplete()) {
                        setTimeout(() => {
                            if (isOTPComplete()) {
                                submitBtn.click();
                            }
                        }, 300);
                    }
                });
            });

            function updateOTPCode() {
                const code = Array.from(otpInputs).map(input => input.value).join('');
                otpCodeInput.value = code;
            }

            function isOTPComplete() {
                return Array.from(otpInputs).every(input => input.value.length === 1);
            }

            // Form submission
            verificationForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                // Validation
                if (!isOTPComplete()) {
                    showError('الرجاء إدخال رمز التحقق كاملاً');
                    return;
                }

                const otp = otpCodeInput.value;

                // Type checking
                if (typeof otp !== 'string' || otp.length !== 6 || !/^\d+$/.test(otp)) {
                    showError('رمز التحقق يجب أن يكون 6 أرقام');
                    return;
                }

                // Disable button and show loading
                submitBtn.disabled = true;
                btnText.textContent = 'جاري التحقق...';
                btnSpinner.style.display = 'inline-block';

                try {
                    const response = await fetch(verificationForm.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            otp_code: otp
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'فشل التحقق');
                    }

                    successMessage.classList.add('show');
                    setTimeout(() => {
                        window.location.href = data.redirect_url ||
                            '{{ route('contracts.create') }}';
                    }, 2000);
                } catch (error) {
                    showError(error.message || 'حدث خطأ أثناء التحقق');
                    submitBtn.disabled = false;
                    btnText.textContent = 'تحقق الآن';
                    btnSpinner.style.display = 'none';
                }
            });

            function showError(message) {
                errorText.textContent = message;
                errorMessage.classList.add('show');
                setTimeout(() => {
                    errorMessage.classList.remove('show');
                }, 5000);
            }

            // Resend OTP
            resendLink.addEventListener('click', async (e) => {
                e.preventDefault();

                if (resendLink.classList.contains('disabled')) {
                    return;
                }

                try {
                    const response = await fetch('{{ route('client.resend-otp', $client->id ?? 0) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'فشل إعادة الإرسال');
                    }

                    // Clear OTP inputs
                    otpInputs.forEach(input => input.value = '');
                    otpInputs[0].focus();

                    // Reset timer
                    startTimer();
                    timerElement.classList.remove('expired');
                    errorMessage.classList.remove('show');
                } catch (error) {
                    showError(error.message || 'حدث خطأ');
                }
            });

            // Start timer on load
            startTimer();

            // Focus on first input
            otpInputs[0].focus();
        });
    </script>
</body>

</html>
