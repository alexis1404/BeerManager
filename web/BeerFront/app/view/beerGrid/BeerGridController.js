Ext.define('BeerFront.view.beerGrid.BeerGridController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.beerGridController',

    del_beer: function(grid, rowIndex, colIndex) {
        var store = grid.getStore();
        var selectionModel = grid.getSelectionModel(), record;
        selectionModel.select(rowIndex);
        record = selectionModel.getSelection()[0];
        Ext.MessageBox.confirm('Delete', 'Are you sure?', function(btn) {
            if(btn === 'yes') {
                store.remove(record);
                store.sync();
            }else {
                console.log('Delete reject')
            }
        });
    },

    saveAllChangesInBeersGrid: function(button) {
        var grid = button.up('#BeerGrid');
        var store = grid.getStore();
        store.sync();
        store.load();
    },

    createBeer: function(button) {
        var grid = button.up('#BeerGrid');
        var store = grid.getStore();
        var r = Ext.create('Beer', {
            'name': 'NEW BEER',
            'style': 'UNKNOWN',
            'og': 0.00,
            'abv': 0.00,
            'ibu': 0.00,
            'volume': 0.00,
            'cost': 0.00,
            'status': 0
        });
        store.insert(0, r);
    }

});