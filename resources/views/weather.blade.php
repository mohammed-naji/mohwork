<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        form {
            position: relative;
        }

        form span {
            position: absolute;
            right: 10px;
            top: 15px;
            display: none;
        }
    </style>
</head>
<body>

    <div class="container my-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <form action="">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter Country Name">
                    <span><i class="fas fa-spinner fa-spin"></i></span>
                </form>

                <div class="mt-5 d-none temp-result">
                    <h2>Weather in <span id="city"></span></h2><br/>
                    <p style="font-size: 4rem;"> <img width="50" src="" alt=""> <span id="temp"></span> &deg;C</p>

                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        let url = 'https://api.openweathermap.org/data/2.5/weather';

        document.querySelector('form').onsubmit = (e) => {
            e.preventDefault();

            let city = document.querySelector('input').value

            document.querySelector('form span').style.display = 'block'

            axios.get(url, {
                    params:{
                        q : city,
                        appid: 'dccab945679f3bb9019537a309e05e47',
                        units: 'metric'
                    }
                }
            )
            .then(res => {
                if(res.data) {
                    let img = 'https://openweathermap.org/img/wn/'+res.data.weather[0].icon+'@2x.png'
                    document.querySelector('.temp-result').classList.remove('d-none')
                    document.querySelector('#city').innerHTML = city
                    document.querySelector('img').src = img
                    document.querySelector('#temp').innerHTML = res.data.main.temp
                    document.querySelector('form span').style.display = 'none'
                }

            })
            .catch(err => {
                console.log("Errrrrorrrr");
                document.querySelector('.temp-result').classList.add('d-none')
                document.querySelector('form span').style.display = 'none'
            })
        }
    </script>
</body>
</html>
