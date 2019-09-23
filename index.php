<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>



    <div id="app">
        <h1 @click="tutorialDemo">Counter = #{{counter}}</h1>

        <form class="border m-2 p-4" :class="typeJob == 'list' ? 'border-primary' : 'border-danger'">
            <div class="form-row">
                <div class="form-group col-md-6">

                    <div class="form-group">
                        <input type="radio" name="type" v-model="typeJob" value="list" :checked="typeJob == 'list'">
                        Список
                        <input type="radio" name="type" v-model="typeJob" value="search" :checked="typeJob == 'serch'">
                        Поиск
                    </div>

                    <div v-if="typeJob == 'search'" class="form-group">
                        <label>Поиск: {{search}}</label>
                        <label v-if="search.length">Кол-во символов: {{search.length}}</label>
                    </div>

                    <div v-if="typeJob == 'search'" class="form-group">
                        <input type="text" class="form-control" name="search" v-model="search" placeholder="Введите искомое значение"></input>
                    </div>

                    <div v-if="checkPick.length" class="form-group">
                        {{checkPick}} - {{checkPick.length}}
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="jumbotron">
                        <div v-if="typeJob == 'search'" class="form-check" v-for="hashtag in hashtags">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" v-model="checkPick" :value="hashtag">
                                {{hashtag}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <a href="#" @click="tutorialDemo">link</a>
        {{ typeJob }}
        <label for="" :title="getData">Проверка времени</label>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script>
        "use strict";
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                getData: "Текущее время: " + new Date().toLocaleString(),
                typeJob: 'list',
                counter: 0,
                search: '',
                hashtags: [],
                checkPick: []
            },
            watch: {
                search: function () {
                    this.search.length >=2 ? this.lookupHashtag() : this.hashtags = [];
                }
            },
            methods: {
                tutorialDemo: function () {
                    this.counter++;
                },
                lookupHashtag() {
                    $.ajax ({
                        url: '/testRequest.php',
                        dataType: 'json',
                        data: {name : app.search},
                        succes: function (json) {
                            console.log('succes');
                            app.hashtags = json;
                            console.log(app.hashtags());
                            console.log('succes');
                        },
                        // error: function (d) {
                        //     console.log (d);
                        //     console.log ('error');
                        // },
                        error: function(xhr,status,error){
                            console.log(status);
                            console.log(error);
                        },

                        complete: function () {
                            console.log ('complete');
                        },
                        // dataFilter: function (d) {
                        //     console.log (d);
                        //     console.log ('dataFilter');
                        // }
                    });
                }
            }
        })
    </script>
</body>

</html>