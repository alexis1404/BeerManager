Ext.define('BeerFront.view.beerCashbox.BeerCashboxGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'cashboxGrid',
    itemId: 'CashboxGrid',
    id: 'csbxBeer',
    store: 'Beers',
    controller: 'cashboxGridController',
    margin: 10,

    tbar: [
        {
            xtype: 'button',
            text: 'Load all beermarks',
            name: 'loadAllBeermarksButton',
            handler: 'loadAllbeermarks'
        }
    ],

    columns: [
        {
            header: 'Beer Mark',
            dataIndex: 'name',
            flex:1,
            editor: {
                allowBlank: false,
                xtype: 'textfield'
            }
        },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'CASHBOX',
            items: [{
                icon: 'images/calc.png',
                handler: 'calcBeer'
            }]
        }

    ]
});