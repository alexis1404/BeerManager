Ext.define('BeerFront.view.producerGrid.ProducerGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'producerGrid',
    itemId: 'PgoducerGrid',
    id: 'pGrid',
    store: 'Producers',
    controller: 'producerGridController',
    margin: 10,
    selType: 'rowmodel',
    plugins:[{
        ptype:'rowediting',
        clicksToEdit: 2,
        pluginId: 'roweditingId'
    }],

    tbar: [
        {
            xtype: 'button',
            text: 'Save all changes',
            name: 'saveChangesButton_1',
            handler: 'saveAllChangesInProducersGrid'
        },
        {
            xtype: 'button',
            text: 'Add new producer',
            name: 'addProducerButton',
            handler: 'createProducer'
        },
        {
            xtype: 'button',
            text: 'Show all beermarks',
            name: 'showAllBeermarksButton',
            handler: 'showAllBeermarks',
            id: 'shwAllBMK'
        }
    ],

    columns: [
        {
            header: 'Name',
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
            header: 'DELETE PRODUCER',
            items: [{
                icon: 'images/delete.png',
                handler: 'del_producer'
            }]
        },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'PRODUCER`S BEERS',
            items: [{
                icon: 'images/beer.jpg',
                handler: 'allProducersBeers'
            }]
        }
    ]
});