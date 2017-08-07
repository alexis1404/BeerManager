Ext.define('BeerFront.view.producerGrid.ProducerGridController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.producerGridController',

    del_producer: function(grid, rowIndex, colIndex) {
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

    saveAllChangesInProducersGrid: function(button) {
        var grid = button.up('#PgoducerGrid');
        var store = grid.getStore();
        store.sync();
        store.load();
    },

    createProducer: function(button) {
        var grid = button.up('#PgoducerGrid');
        var store = grid.getStore();
        var r = Ext.create('Producer', {
            'name': 'NEW PRODUCER'
        });
        store.insert(0, r);
    },

    allProducersBeers: function(grid, rowIndex, colIndex) {
        var bagPanel = Ext.get('bGrid');
        bagPanel.slideIn('t', {
            easing: 'easeIn',
            duration: 300
        });

        var addNewBeerButton = Ext.get('addNewBeer_B1');
        addNewBeerButton.show();
        var selectionModel = grid.getSelectionModel(), record;
        selectionModel.select(rowIndex);
        record = selectionModel.getSelection()[0];
        var storeBeers = Ext.getStore('Beers');
        storeBeers.getProxy().getApi().read = '/get_all_producers_beers/' + record.get('id');
        storeBeers.getProxy().getApi().create = '/create_beer/' + record.get('id');
        storeBeers.load();
        var audio = new Audio('sounds/cork.mp3');
        audio.play();
    },

    showAllBeermarks: function(button) {
        var bagPanel = Ext.get('bGrid');
        bagPanel.slideIn('t', {
            easing: 'easeIn',
            duration: 300
        });
        var createNewBeerButton = Ext.get('addNewBeer_B1');
        createNewBeerButton.hide();
        var store = Ext.getStore('Beers');
        store.getProxy().getApi().read = '/get_all_beers';
        store.load();
        //-------------------------------------------
        for(i = 0; i < store.count(); i++){
            console.log(store.getAt(i).get('name'));
        }
    }

});