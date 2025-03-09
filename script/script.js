let dis = 0;

function toggle(){
    let menu = document.getElementById("menu_op");
    let arrow = document.getElementById("left_ind");
    if(dis == 1)
        {
            // menu.style.backgroundColor = "orange"
            menu.style.display = "block";
            arrow.style.rotate = "0deg";
            dis = 0;
        }
else{
    menu.style.display = "none";
    arrow.style.rotate = "-90deg";
    dis = 1;
}
   }

   function nav_toggle(){
    let menu_nav = document.getElementById("navigation");
    let btn = document.getElementById("menu_opt_btn");
    if(dis == 1)
        {
            // menu.style.backgroundColor = "orange"
            menu_nav.style.display = "block";
            menu_nav.style.animation = "slidetoright .5s ease-in-out";
            btn.style.color = "orange";
            dis = 0;
        }
else{
    menu_nav.style.animation = "slidetoleft .5s ease-in-out";
    btn.style.color = "white";
    menu_nav.style.display = "none";
    dis = 1;


   }
}

// const paymentButton = document.getElementById('payment-button');
const paymentPopup = document.getElementById('payment-popup');
const paymentGatewayIframe = document.getElementById('payment-gateway');

// Add an event listener to the payment button
 function pay_toggle(){
  // Open the payment popup div
  paymentPopup.style.display = 'block';

  // Load the payment gateway URL in the iframe
  paymentGatewayIframe.src = './PaymentGatway.php';
}

function cancel_pay(){
    paymentPopup.style.display = 'none';
}

document.querySelectorAll('input[name="payment-mode"]').forEach((radio) => {
    radio.addEventListener("change", (event) => {
      const value = event.target.value;
      // Hide all divs
      document.querySelectorAll(".content").forEach((div) => {
        div.style.display = "none";
      });
  
      // Show the selected div
      const selectedDiv = document.getElementById(value);
      if (selectedDiv) {
        selectedDiv.style.display = "block";
      }
    });
  });
  