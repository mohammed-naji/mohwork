<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            color: #127a7a;
            font-size: 20px;
            z-index: 99;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all .5s ease
        }

        .loading.hide {
            opacity: 0;
            visibility: hidden
        }

        .lds-heart {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            transform: rotate(45deg);
            transform-origin: 40px 40px;
        }
            .lds-heart div {
            top: 32px;
            left: 32px;
            position: absolute;
            width: 32px;
            height: 32px;
            background: #ff0000;
            animation: lds-heart 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            .lds-heart div:after,
            .lds-heart div:before {
            content: " ";
            position: absolute;
            display: block;
            width: 32px;
            height: 32px;
            background: #ff0000;
            }
            .lds-heart div:before {
            left: -24px;
            border-radius: 50% 0 0 50%;
            }
            .lds-heart div:after {
            top: -24px;
            border-radius: 50% 50% 0 0;
            }
            @keyframes lds-heart {
            0% {
                transform: scale(0.95);
            }
            5% {
                transform: scale(1.1);
            }
            39% {
                transform: scale(0.85);
            }
            45% {
                transform: scale(1);
            }
            60% {
                transform: scale(0.95);
            }
            100% {
                transform: scale(0.9);
            }
        }

        .card img {
            height: 200px;
            object-fit: contain
        }
    </style>
</head>
<body>

    <div class="loading">
        <div class="lds-heart"><div></div></div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($products['products'] as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $product['thumbnail'] }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product['title'] }}</h5>
                        <p class="card-text">{{ $product['description'] }}</p>
                        <a href="/api/product/{{ $product['id'] }}" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <script>
        window.onload = () => {
            document.querySelector('.loading').classList.add('hide')
        }
    </script>
</body>
</html>
