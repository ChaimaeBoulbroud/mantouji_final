<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>
<body>
    <div class="home">
        <x-navbar />
        <div class="content-container" id="Accueil">
            <div class="content">
                <div class="left-content">
                    <p>La richesse de Figuig dans chaque <span>produit</span></p>
                    <p>تمور وحرف فكيك… أصالة تعبر الأجيال</p>
                </div>
            </div>
        </div>
    </div>

    <div class="figuig-to-you-container" id="propo">
        <div class="figuig-to-you"> 
            <p>De Figuig à vous</p>
        </div>
        <div class="figuig-to-you-content">
            <p>
                Mantouji est une plateforme dédiée à la valorisation des produits agricoles, agroalimentaires et
                artisanaux, avec un ancrage fort dans la région de Figuig.
                Elle met en relation directe les producteurs, coopératives et artisans locaux avec les
                consommateurs et partenaires, en garantissant authenticité, traçabilité et qualité.
            </p>
            <p>
                هدفنا هو دعم الاقتصاد المحلي، إبراز هوية فكيك التراثية، وتقديم منتجات عالية الجودة مباشرة من المنتج إلى المستهلك.
            </p>
        </div>
        <div class="ligne">
            <div class="ligne-container">
                <img src="/images/bg/ligne.jpeg" alt="" srcset="">
                <img src="/images/bg/ligne.jpeg" alt="" srcset="">
            </div>
        </div>
    </div>
    <div class="auth" id="service">
        <div class="auth-header">
            <p>Please Tell us who you are !</p>
        </div>
        <div class="auth-cards">
            <div class="card">
                <div class="card-content-header">
                    <div class="card-content">
                        <div class="card-container-image">
                            <img src="/images/icones/client.png" alt="" srcset="">
                        </div>
                        <p><a href="{{Route('register', ['type' => 0])}}">Client ?</a></p>
                    </div>
                </div>
            </div>
            <div class="auth-card-or">
                <p>OR</p>
            </div>
            <div class="card">
                <div class="card-content-header">
                    <div class="card-content">
                        <div class="card-container-image">
                            <img src="/images/icones/store.png" alt="" srcset="">
                        </div>
                        <p><a href="{{Route('register', ['type' => 1])}}">Association ?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer" id="conta">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/images/logo.png" alt="" srcset="">
            </div>
            <div class="footer-links-container">
                <div class="footer-links">
                    <ul>
                        <li style="font-weight: bold">Information</li>
                        <li style="margin-top: 15px"><a href="#">Industry analystics</a></li>
                        <li><a href="#">News and release</a></li>
                        <li><a href="#">Events</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <ul>
                        <li style="font-weight: bold">Useful Links</li>
                        <li style="margin-top: 15px"><a href="#acc">Acceuile</a></li>
                        <li><a href="#propo">A propos</a></li>
                        <li><a href="#service">Services</a></li>
                        <li><a href="#conta">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <ul>
                        <li style="font-weight: bold">Contact</li>
                        <li style="margin-top: 15px"><a href="https://www.tech-da.com/">Tech-da</a></li>
                        {{-- <li>Home</li>
                        <li>Home</li>
                        <li>Home</li> --}}
                    </ul>
                </div>
            </div>

            <div class="footer-logo">
                <img src="/images/bg/footer.png" alt="" srcset="" style="border-radius: 12px; padding-top: 30px; padding-bottom: 15px;">
            </div>
        </div>
        <hr style="width: 90%; margin: auto; margin-top: 20px; border: 0.5px solid gray">
        <div class="footer-bottom">
            <div>
                <p>Copyright</p>
            </div>
            <div class="footer-terms">
                <ul>
                    <li>Terms</li>
                    <li>Privacy</li>
                    <li>Police and Cookie Policy</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="js/navbar.js"></script>
</body>
</html>