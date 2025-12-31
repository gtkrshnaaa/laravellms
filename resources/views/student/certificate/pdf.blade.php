<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan - {{ $course->name }}</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            border: 10px solid #ddd;
        }
        .header {
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 36px;
            text-transform: uppercase;
            color: #333;
            margin: 0;
        }
        .content {
            margin-bottom: 40px;
        }
        .student-name {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
        }
        .course-name {
            font-size: 28px;
            font-style: italic;
            margin: 10px 0;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
            width: 200px;
            margin: 0 auto;
        }
        .date {
            font-size: 14px;
            color: #666;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sertifikat Kelulusan</h1>
            <p>Nomor: LARAVEL/{{ $completionDate->format('Y') }}/{{ strtoupper(substr($course->id, 0, 4)) }}/{{ strtoupper(substr($certificate->id, 0, 4)) }}</p>
        </div>

        <div class="content">
            <p>Diberikan kepada:</p>
            <div class="student-name">{{ $student->name }}</div>
            <p>Atas keberhasilannya menyelesaikan kursus:</p>
            <div class="course-name">{{ $course->name }}</div>
        </div>

        <div class="footer">
            <div class="signature">
                <p class="date">Yogyakarta, {{ $completionDate->format('d F Y') }}</p>
                <br><br><br>
                <hr>
                <strong>Manajemen Laravel</strong>
            </div>
        </div>
    </div>
</body>
</html>
