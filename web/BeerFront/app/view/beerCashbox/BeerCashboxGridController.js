Ext.define('BeerFront.view.beerCashbox.BeerCashboxGridController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.cashboxGridController',

    calcBeer: function(grid, rowIndex, colIndex) {
        var store = grid.getStore();
        var selectionModel = grid.getSelectionModel(), record;
        selectionModel.select(rowIndex);
        record = selectionModel.getSelection()[0];
        var currentBeerList = Ext.get('csbxBeer');
        currentBeerList.hide();

        var displayPanel = Ext.create('Ext.form.Panel',{
            title: 'RESULT',
            width: 300,
            height:300,
            border: 1,
            layout: 'anchor',
            html: '<p align="center" id="summIndicator"></p>' + '<p align="center" id="volIndicator"></p>' + '<p align="center" id="beername"></p>',
            defaults: {
                anchor: '80%'
            },
            renderTo: 'displayResultPanel'
        });

        displayPanel.hide();

        var beerCalcPanel = Ext.create('Ext.form.Panel',{
            title: 'BEER CALCULATOR',
            width: 300,
            height:300,
            border: 1,
            layout: 'anchor',
            html: '<p align="center" id="beerIndicator"><b>CurrentBeer: ' + record.get('name') + '</b></p>' +
            '<p align="center" id="volumeIndicator"><b>Rest volume: ' + record.get('volume') +'</b></p>',
            defaults: {
                anchor: '80%'
            },
            renderTo: 'calcPanel',
            items:[{
                xtype: 'numberfield',
                fieldLabel: 'Liters of beer bought',
                name: 'beerVolumeLeft',
                margin: 20,
                labelAlign: 'top',
                cls: 'field-margin',
                flex: 1
            }],
            buttons: [{
                text: 'Count and save result',
                handler: function() {
                    var formBeerCalculatorpanel = beerCalcPanel.getForm();
                    var beerVolumeBought = formBeerCalculatorpanel.getValues().beerVolumeLeft;
                    if(beerVolumeBought){
                        var currentBeerVolume = record.get('volume');
                        record.setVolume(currentBeerVolume - beerVolumeBought);
                        store.sync();
                        store.load();
                        var summImdicator = Ext.get('summIndicator');
                        var volumeIndicator= Ext.get('volIndicator');
                        var beerNameIndicator = Ext.get('beername');
                        summImdicator.update('<b>Total: </b>' + record.get('cost') * beerVolumeBought);
                        volumeIndicator.update('<b>Rest volume: </b>' + record.get('volume'));
                        beerNameIndicator.update('<b>Beer: </b>' + record.get('name'));
                        displayPanel.show();
                        currentBeerList.show();
                        beerCalcPanel.destroy();
                    }
                }
            },
                {
                    text: 'EXIT',
                    handler: function() {
                        beerCalcPanel.destroy();
                        currentBeerList.show();
                    }
                }
                ]
        });
    },

    loadAllbeermarks: function(button) {
        var grid = button.up('#CashboxGrid');
        var store = grid.getStore();
        store.getProxy().getApi().read = '/get_all_beers';
        store.load();
    }

});