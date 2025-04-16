<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel with Bootstrap</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('/css/bootstrap.min.css') }}">


</head>
<body>

<div class="text-center">

    <form id="data__form" >
        <select id="data__list" name="data__list[]">

        </select>

        <!-- Кнопка для відправки угод -->
        <button id="sendDataAccaunts" class="btn btn-primary mt-5">Відправити дані</button>
    </form>



</div>

<!-- Scripts -->
<script src="{{ secure_asset('js/lib/zoho/ZohoEmbededAppSDK.min.js') }}"></script>
<!-- Підключення чистого JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Отримуємо кнопку по ідентифікатору
        let sendDataAccauntsButton = document.getElementById('sendDataAccaunts');
        let dataList = document.getElementById('data__list');

        // Обробник події кліку на кнопку
        sendDataAccauntsButton.addEventListener('click', function(e) {
            e.preventDefault();
            let selectedOptions = Array.from(dataList.selectedOptions);
            let selectedDeals = selectedOptions.map(option => option.value);
            console.log("Selected deals:", selectedDeals);
            // Відправка даних на сервер
            fetch('https://21a5-95-47-148-14.ngrok-free.app/handle-webhook', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({deals: selectedDeals})
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    alert('Дані успішно відправлені');
                    ZOHO.CRM.UI.Popup.close();
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Сталася помилка при відправці даних');
                });
        });

        ZOHO.embeddedApp.on("PageLoad", async function (data) {
            console.log("data="+ data?.EntityId[0]);
            let accID = data?.EntityId[0];

            let dealsData = await ZOHO.CRM.API.getRelatedRecords({
                Entity:"Accounts",
                RecordID: accID,
                RelatedList: "Deals",
                page:1,
                per_page:200
            });
            console.log(dealsData);

            dealsData.data.forEach(deal => {
                let option = document.createElement('option');
                option.value = deal.id; // Ідентифікатор угоди
                option.textContent = deal.Deal_Name; // Назва угоди або будь-яке інше поле
                dataList.appendChild(option);
            });
            // Якщо потрібно зробити мульти-вибір
            dataList.setAttribute('multiple', 'multiple');


        })

        // Ініціалізація Zoho
        ZOHO.embeddedApp.init();
    });
</script>

</body>
</html>
