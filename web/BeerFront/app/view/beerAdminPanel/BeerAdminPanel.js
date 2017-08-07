Ext.define('BeerFront.view.beerAdminPanel.BeerAdminPanel', {
    extend: 'Ext.tab.Panel',
    requires: [
        'Ext.layout.container.Card',
        'BeerFront.view.beerAdminPanel.BeerAdminPanelController',
        'BeerFront.view.producerGrid.ProducerGridController',
        'BeerFront.view.beerGrid.BeerGridController',
        'BeerFront.view.beerCashbox.BeerCashboxGridController'
    ],
    xtype: 'layout-adminBeerPanel',
    controller: 'beerAdminPanel',

    defaults: {
        bodyPadding: 15
    },

    items:[
        {
            title: 'BEER LIST',
            items: [
                {
                    xtype: 'producerGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 500,
                    height: 300
                },
                {
                    xtype: 'beerGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 1300,
                    height: 500
                }
            ]
        },
        {
            title: 'BEER CASHBOX',
            items: [
                {
                    xtype: 'cashboxGrid',
                    style: 'border: 1px double #FFFFFF',
                    width: 500,
                    height: 300
                },
                {
                    xtype: 'panel',
                    width: 500,
                    height: 300,
                    html: '<div id="calcPanel"></div>'
                },
                {
                    xtype: 'panel',
                    width: 300,
                    height: 300,
                    style: 'position: absolute; left: 40%; top: 5%',
                    html: '<div id="displayResultPanel"></div>'
                }
            ]
        }
    ]
});