module.exports = {
    handleFacebookSdk: function(app_id, api_version){
        window.fbAsyncInit = function() {
            FB.init({
            appId      : 3093684740891759,
            cookie     : true,
            xfbml      : true,
            version    : 'v12.0'
            });
            
            FB.AppEvents.logPageView();   
            
        };
        
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    },

    checkLoginState: function(){
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

}