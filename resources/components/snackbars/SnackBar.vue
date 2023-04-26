<template>
    <div id="snackbar" class="row">
        <p id="snackbar_message">{{message}}</p>
        <button id="snackbar_button_text" v-if="buttonText != null" class="btn btn-primary ml-3" @click="handleClick()">{{buttonText}}</button>
    </div>
</template>

<script>

export default{
    data() {
        return {
          message: String,
          buttonText: String,
          onClick: Function,
        };
    },
    methods:{
        handleClick(){
          this.onClick();
        },
        
        showSnackbar(message, buttonText, onClick) {
            var snackbar = document.getElementById("snackbar");

            var buttonTextElement = document.getElementById("snackbar_button_text");
            var messageElement = document.getElementById("snackbar_message");

            this.message = message;
            this.buttonText = buttonText;
            this.onClick = onClick || function(){};

            if(buttonTextElement != null){
              buttonTextElement.textContent = buttonText;
            }
            if(messageElement != null){
              messageElement.textContent = message;
            }
          
            snackbar.className = "show";
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 6000);
        },
        
    },
};
</script>

<style>
#snackbar {
    visibility: hidden;
    min-width: 250px;
    width: 98%;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    bottom: 30px;
    left: 0px;
    margin: 10px;
  }
  
  #snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 5.5s;
    animation: fadein 0.5s, fadeout 0.5s 5.5s;
  }
  
  @-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
  }
  
  @keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
  }
  
  @-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
  }
  
  @keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
  }
</style>
