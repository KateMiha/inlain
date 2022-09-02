<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>InlainTest</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"
            defer></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="input-group mt-3" id="input-group">
                <button class="btn btn-outline-success" type="button" id="button-search">Поиск</button>
                <input type="search" class="form-control" placeholder="Введите поисковой запрос" id="input-search"
                       autofocus>
            </div>
            <label for="input-group"><small class="text-danger" id="messange"></small></label>
            <div class=" py-2 px-4" id="artisleList">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).keypress(function (e) {
        if (e.which == 13) search();
    });
    $('#button-search').on('click', function () {
        search();
    });

    function search() {
        $('#messange').text('');
        let words = $('#input-search').val();
        if (words.length < 3) {
            $('#messange').text('Минимальная длинна запроса 3 символа');
            $('#artisleList').html("");
        } else {
            $.ajax({
                type: "GET",
                url: `/inlain/search.php`,
                dataType: 'html',
                data: {
                    text: words
                },
                success: function (result) {

                    let html = "";
                    result = JSON.parse(result);
                    for (let i = 0; i < result.length; i++) {
                        html = html +
                        `<div class="card p-3 mt-2">
                            <div class="col-12 mb-1 h6 text-uppercase">${result[i]['title']}</div>`;
                        for (let a = 0; a < result[i]['comments'].length; a++) {
                            html = html +
                                `<div class="row border-top mt-2"><div class="col-3 text-secondary ">
                                    <small>User: ${result[i]['comments'][a]['email']}</small>
                                </div>
                                <div class="col-9">Comment: ${result[i]['comments'][a]['body']}</div></div>`;
                        }
                        html = html + `</div>`;
                    }
                    $('#artisleList').html(html);
                }
            });
        }
    }
</script>
</body>
</html>
