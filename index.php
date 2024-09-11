<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout com 3 Menus</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add a black background color to the top navigation */
        .topnav {
            background-color: #333;
            overflow: hidden;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Add an active class to highlight the current page */
        .active {
            background-color: #04AA6D;
            color: white;
        }

        /* Hide the link that should open and close the topnav on small screens */
        .topnav .icon {
            display: none;
        }

        /* Dropdown container - needed to position the dropdown content */
        .dropdown {
            float: left;
            overflow: hidden;
        }

        /* Style the dropdown button to fit inside the topnav */
        .dropdown .dropbtn {
            font-size: 17px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        /* Style the dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Style the links inside the dropdown */
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Add a dark background on topnav links and the dropdown button on hover */
        .topnav a:hover,
        .dropdown:hover .dropbtn {
            background-color: #555;
            color: white;
        }

        /* Add a grey background to dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Show the dropdown menu when the user moves the mouse over the dropdown button */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
        @media screen and (max-width: 600px) {

            .topnav a:not(:first-child),
            .dropdown .dropbtn {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: relative;
            }

            .topnav.responsive a.icon {
                position: absolute;
                right: 0;
                top: 0;
            }

            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }

            .topnav.responsive .dropdown {
                float: none;
            }

            .topnav.responsive .dropdown-content {
                position: relative;
            }

            .topnav.responsive .dropdown .dropbtn {
                display: block;
                width: 100%;
                text-align: left;
            }
        }


        #menuVertical{
    .vertical-menu {
        width: 200px; /* Set a width if you like */
      }
      
      .vertical-menu a {
        background-color: #eee; /* Grey background color */
        color: black; /* Black text color */
        display: block; /* Make the links appear below each other */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove underline from links */
      }
      
      .vertical-menu a:hover {
        background-color: #ccc; /* Dark grey background on mouse-over */
      }
      
      .vertical-menu a.active {
        background-color: #04AA6D; /* Add a green color to the "active/current" link */
        color: white;
      }
}

 /* Add a black background color to the top navigation */
 .topnav {
    background-color: #333;
    overflow: hidden;
    max-width: 1200px;
    margin: 0 auto;
}

/* Style the links inside the navigation bar */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

/* Add an active class to highlight the current page */
.active {
    background-color: #04AA6D;
    color: white;
}

/* Hide the link that should open and close the topnav on small screens */
.topnav .icon {
    display: none;
}

/* Dropdown container - needed to position the dropdown content */
.dropdown {
    float: left;
    overflow: hidden;
}

/* Style the dropdown button to fit inside the topnav */
.dropdown .dropbtn {
    font-size: 17px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

/* Style the dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

/* Style the links inside the dropdown */
.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

/* Add a dark background on topnav links and the dropdown button on hover */
.topnav a:hover,
.dropdown:hover .dropbtn {
    background-color: #555;
    color: white;
}

/* Add a grey background to dropdown links on hover */
.dropdown-content a:hover {
    background-color: #ddd;
    color: black;
}

/* Show the dropdown menu when the user moves the mouse over the dropdown button */
.dropdown:hover .dropdown-content {
    display: block;
}

/* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
@media screen and (max-width: 600px) {

    .topnav a:not(:first-child),
    .dropdown .dropbtn {
        display: none;
    }

    .topnav a.icon {
        float: right;
        display: block;
    }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
@media screen and (max-width: 600px) {
    .topnav.responsive {
        position: relative;
    }

    .topnav.responsive a.icon {
        position: absolute;
        right: 0;
        top: 0;
    }

    .topnav.responsive a {
        float: none;
        display: block;
        text-align: left;
    }

    .topnav.responsive .dropdown {
        float: none;
    }

    .topnav.responsive .dropdown-content {
        position: relative;
    }

    .topnav.responsive .dropdown .dropbtn {
        display: block;
        width: 100%;
        text-align: left;
    }
}
    </style>
</head>

<body>
    <div class="topnav" id="myTopnav">
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
        <a href="#home" class="active">Home</a>
        <a href="#quemSomos">Quem somos</a>
        <a href="Simposio/">Simpósio</a>
        <div class="dropdown">
            <button class="dropbtn">Anais do Simpósio
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#apresentacao">Apresentação</a>
                <a href="#corpoEditorial">Corpo Editorial</a>
                <a href="#expediente">Expediente</a>
                <a href="#normasParaPublicacao">Normas para publicação</a>
                <a href="#atual">Edição atual</a>
                <a href="#anteriores">Edições anteriores</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Livros
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#2016">E-book de 2016</a>
                <a href="#2015">E-book de 2015</a>
            </div>
        </div>
        <a href="#contato">Contato</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>



    <div class="container">
        <div class="left-menu">
            <!-- Conteúdo do menu esquerdo -->
            <h2>Menu Esquerdo</h2>
            <p>Este é o conteúdo do menu esquerdo.</p>
        </div>

        <div class="center-menu" class="tab-content" id="menuCentral">

            <!-- Conteúdo do menu central -->
            <h2>Menu Central</h2>
            <p>Este é o conteúdo do menu central.</p>
        </div>

        <div class="right-menu">
            <div class="vertical-menu" id="menuVertical">
                <a href="#" class="active">Home</a>
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
                <a href="#">Link 4</a>
            </div>
        </div>
    </div>

</body>

</html>