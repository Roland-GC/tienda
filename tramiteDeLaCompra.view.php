<!DOCTYPE html>
<html>
<head>
    <title>Método de Pago</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script scr="https://maxdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>

    
</head>
<body class="body-container">
<div class="body-index"></div>
    <div class="reset-password-container">
        <h1>Método de Pago</h1>
        <h2>Para probar se puede usar la tarjeta 4242 4242 4242 4242</h2>
    <form method="post" action="procesar_pago.php" id="payment-form">
        <input type="text" id="card-holder-name" name="card-holder-name" class="form-control" placeholder="Titular de la tarjeta" required>

        <label for="card-element">Detalles de la tarjeta:</label>
        <div id="card-element"></div>
        <div id="card-errors"></div>
        <a href="carrito.php" class="btn btn-secondary mt-3 ml-2">Volver</a>

              <input type="submit" value="Pagar">

    </form>
 <input type="button" onclick="window.location='carrito.php'" class="btn btn-primary botones-sup-izq" value="Volver" />
     </div>
    <script>
 var stripe = Stripe('pk_test_51MyAMmBZ3HTg0855fAT6ra2VyCitjjkr7jiYYYgxWwLFnA6bzVIBTzGw0ZRo0fGQjyPgad9ENv1WRV5tFMGE4qPL00YFVrlcJ7'); // <---- cambia aquí con tu clave pública de prueba
        const elements = stripe.elements();
const card = elements.create('card', { hidePostalCode: true });

        card.mount('#card-element');


  // Manejar errores de tarjeta en tiempo real
  card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  // Manejar el envío del formulario
  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();

    var cardHolderName = document.getElementById('card-holder-name').value.trim();
    if (cardHolderName === '') {
      alert('Por favor ingresa el nombre del titular de la tarjeta.');
      return;
    }

    stripe.createToken(card).then(function(result) {
      if (result.error) {
        // Mostrar error en la tarjeta
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
      } else {
        // Token creado con éxito
        stripeTokenHandler(result.token);
      }
    });
  });

  // Enviar token al servidor
  function stripeTokenHandler(token) {
    // Crear un campo oculto para enviar el token al backend
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);



    form.submit();
  }

    // Continuar con el envío del formulario


    </script>
</body>
</html>
