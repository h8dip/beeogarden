<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Thasadith:400,400i,700,700i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos2.css">
    <link href="hamburger.css" rel="stylesheet">
    <link href="animation.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/9327c61162.js"></script>
    <title>beeogarden | Carrinho de Compras</title>
</head>
<body>
    <div id="cart-container">
        <h1>O MEU CARRINHO</h1>
        <div id="cart-products">
            <div class="product-cart">
                <input type="checkbox">
                <div class="cart-products-img-container">
                    <img src="img/bee-house.PNG" alt="beehouse">
                </div>
                <div class="product-cart-info">
                    <h3>Casinha para abelhas</h3>
                    <div>QTD:1</div>
                    <h2>44,99€</h2>
                </div>
            </div>
            <div class="product-cart">
                <input type="checkbox">
                <div class="cart-products-img-container">
                    <img src="img/bee-house.PNG" alt="beehouse">
                </div>
                <div class="product-cart-info">
                    <h3>Casinha para abelhas</h3>
                    <div>QTD:1</div>
                    <h2>44,99€</h2>
                </div>
            </div>
            <div class="product-cart">
                <input type="checkbox">
                <div class="cart-products-img-container">
                    <img src="img/bee-house.PNG" alt="beehouse">
                </div>
                <div class="product-cart-info">
                    <h3>Casinha para abelhas</h3>
                    <div>QTD:1</div>
                    <h2>44,99€</h2>
                </div>
            </div>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="price-pay">
        <h2>Preço a pagar</h2>
        <div id="price-pay-info">
            <div class="product-buy">
                <h3>Casinha para abelhas</h3>
                <h2>44,99€</h2>
            </div>
            <div class="product-buy">
                <h3>Casinha para abelhas</h3>
                <h2>44,99€</h2>
            </div>
            <div class="product-buy">
                <h3>Casinha para abelhas</h3>
                <h2>44,99€</h2>
            </div>
            <div class="portes-envio">
                <h3>Portes de Envio</h3>
                <h2>5,99€</h2>
            </div>
            <div class="iva">
                <h3>IVA</h3>
                <h2>1,99€</h2>
            </div>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="total">
        <h2>Total</h2>
        <div id="total-info">
            <div class="total-buy">
                <h3>Total</h3>
                <h2>52,97€</h2>
            </div>
            <div class="line">
                <div class="dotted-line"></div>
            </div>
        </div>
    </div>

    <div id="buy-btn">
        <div><h2>CANCELAR</h2></div>
        <div><h2>FINALIZAR COMPRA</h2></div>
    </div>



<script src="main.js"></script>
</body>