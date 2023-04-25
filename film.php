<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
</head>
<body>
<div id="film-description"></div>

</body>
</html>

<?php
if(isset($_GET['id_movie'])){ ?>
    <script>
        const divDescription = document.getElementById('film-description');
        const imgURL = "https://image.tmdb.org/t/p/original/";

        function getIdMovie(){
            let URL = window.location.href;
            console.log(URL)
            let id = URL.split('=')[1];
            return id;
        }


        fetch('https://api.themoviedb.org/3/movie/'+getIdMovie()+'?api_key=API_KEYÀMETTRE')
            .then(response => response.json())
            .then(data => {
                console.log(data);
                for(let key in data){
                    console.log(key)
                    let value = data[key];
                    console.log(value)
                    let p = document.createElement("p");
                    if(typeof data[key] === "string" ^ typeof data[key] === "number"){
                    if(key == 'backdrop_path' || key == 'poster_path'){
                        let img = document.createElement("img");
                        img.src = imgURL + data[key];
                        img.style = 'width:200px';
                        divDescription.append(img);
                    }else{
                        p.innerHTML = '<b>'+ key+'</b>'+':' + data[key];
                        divDescription.append(p);
                    }
                }
                    // A COMPLETER POUR RÉCUPÉRER LES GENRES DE FILM PAR EXEMPLE
                    else if(Array.isArray(data[key])){
                        console.log('1:'); console.log(data[key]);
                    }
                }
            })
            .catch(error => console.error(error))

    </script>

<?php } else{ ?>
    <script>
        const divDescription = document.getElementById('film-description');
        let p = document.createElement("p");
        p.innerHTML = "Aucun film n'a été choisi";
        divDescription.append(p);
    </script>
<?php } ?>
