<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Page</title>
</head>
<body>
<div id="films"></div>
<div id="pagination"></div>

</body>
</html>

<?php
if(isset($_GET['page'])){ ?>
    <script>
        const divDescription = document.getElementById('films');
        const imgURL = "https://image.tmdb.org/t/p/original/";

        function getIdPage(){
            let URL = window.location.href;
            console.log(URL)
            let id = URL.split('=')[1];
            return id;
        }


        fetch('https://api.themoviedb.org/3/movie/top_rated?api_key=VOTRECLÉAPI&page='+getIdPage())
            .then(response => response.json())
            .then(data => {
                console.log(data);
                let pagination = document.getElementById('pagination');

                pagination.innerHTML = '<a href="films.php?page=1">'+1+'</a>' + '...'+ '<a href="films.php?page=500">500</a>' ;
                data.results.forEach(element => {

                    for(let key in element){
                        let value = element[key];
                        let p = document.createElement("p");
                        if(typeof value === "string" ^ typeof value === "number"){

                            if(key == 'backdrop_path' || key == 'poster_path'){
                                let img = document.createElement("img");
                                img.src = imgURL + value;
                                img.style = 'width:200px';
                                divDescription.append(img);
                            }else{
                                p.innerHTML = '<b>'+ key+'</b>'+':' + value;
                                divDescription.append(p);
                            }
                        }else if(Array.isArray(value)){
                            // value.forEach(element =>  {
                            //     console.log(element)
                            // })
                        }
                    }
                })

            })
            .catch(error => console.error(error))

// pagination



    </script>

<?php } else{
   header('location:films.php?page=1');
}?>
