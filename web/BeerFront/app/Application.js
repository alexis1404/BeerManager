/**
 * The main application class. An instance of this class is created by app.js when it
 * calls Ext.application(). This is the ideal place to handle application launch and
 * initialization details.
 */
Ext.define('BeerFront.Application', {
    extend: 'Ext.app.Application',
    
    name: 'BeerFront',

    stores: [
        // TODO: add global / shared stores here
        'Producers',
        'Beers'
    ],
    
    launch: function () {
        // TODO - Launch the application
        var addNewBeerButton = Ext.get('addNewBeer_B1');
        addNewBeerButton.hide();

    },

    onAppUpdate: function () {
        Ext.Msg.confirm('Application Update', 'This application has an update, reload?',
            function (choice) {
                if (choice === 'yes') {
                    window.location.reload();
                }
            }
        );
    }
});
