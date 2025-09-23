API.success(function(response, endpoint){
    if(typeof response.app === 'undefined') return;
    if(typeof response.app.logLevel === 'undefined') return;
    API.debug((response.app.logLevel >= 5));
});
