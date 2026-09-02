<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- خط Cairo وأيقونات FontAwesome لمظهر عصري -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }

        /* خلفية ناعمة بتدرج هادئ مع أشكال تزينية */
        .hero {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: radial-gradient(circle at 10% 20%, rgba(108, 92, 231, 0.05) 0%, rgba(9, 132, 227, 0.05) 90%);
            position: relative;
            padding: 2rem 1rem;
        }

        /* كارت واجهة Landing */
        .hero-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            box-shadow: 0 20px 40px rgba(108, 92, 231, 0.08);
            border: 1px solid rgba(108, 92, 231, 0.1);
            max-width: 580px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        /* أيقونة رأس الصفحة */
        .hero-icon-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(108, 92, 231, 0.1) 0%, rgba(9, 132, 227, 0.1) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
        }

        .hero-icon-box i {
            font-size: 2.2rem;
            color: #6c5ce7;
        }

        .hero h1 {
            color: #2c3e50;
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .hero p {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        /* زر الإجراء الأساسي بتدرج احترافي */
        .btn-custom {
            background: linear-gradient(135deg, #6c5ce7 0%, #0984e3 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.3);
            transition: all 0.3s ease;
            border: none;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #5b4bc4 0%, #0773c5 100%);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(108, 92, 231, 0.4);
        }
    </style>
</head>

<body>

<div class="hero">
    <div class="hero-card">
        <div class="hero-icon-box">
            <i class="fa-solid fa-user-doctor"></i>
        </div>

        <h1>Clinic Management System</h1>
        <p>احجز معادك بسهولة في ثواني</p>

        <a href="/book" class="btn btn-custom">
            <span>Book Appointment</span>
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
</div>

</body>
</html>
