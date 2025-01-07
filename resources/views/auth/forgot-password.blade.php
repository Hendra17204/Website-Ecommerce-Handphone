<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Password</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #e8f5e9;
            /* Latar belakang hijau muda */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: 0;
            /* Menghapus margin untuk memenuhi layar */
        }

        .container {
            width: 400px;
            /* Lebar container */
            background-color: #fff;
            border-radius: 10px;
            /* Sudut yang halus */
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            padding: 20px;
            /* Padding di dalam container */
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0;
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px;
            /* Sudut yang halus untuk input */
        }

        button {
            border-radius: 20px;
            border: 1px solid #4CAF50;
            /* Warna hijau untuk border */
            background-color: #4CAF50;
            /* Warna hijau untuk tombol */
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 0;
            /* Padding vertikal */
            letter-spacing: 1px;
            text-transform: uppercase;
            width: 100%;
            /* Lebar tombol 100% */
            transition: transform 80ms ease-in;
            cursor: pointer;
            /* Menunjukkan bahwa tombol dapat diklik */
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        .text-center {
            text-align: center;
            margin-top: 20px;
        }

        .text-center a {
            color: #4CAF50;
            /* Warna hijau untuk tautan */
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
            /* Garis bawah saat hover */
        }

        .invalid-feedback {
            color: red;
            /* Warna merah untuk pesan error */
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h4>Lupa Password</h4>
        <p>Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang password Anda.</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit">Kirim Tautan Reset Password</button>
        </form>
        <div class="text-center">
            <p>Ingat password Anda? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</body>

</html>
