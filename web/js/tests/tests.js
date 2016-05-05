

QUnit.test( "bonusCardModule.toggleStatus", function( assert ) {

    var mockAjax = $.mockjax({
        url: '/bonus-card/toggle/1.json',
        responseText: {
            id: 1,
            status: "active"
        }
    });

    var callbackMock = function(res) {
        return res;
    };

    BonusCardModule.init({ajax:mockAjax});
    var bonusCardModule = BonusCardModule;
    var res = bonusCardModule.toggleStatus('/bonus-card/toggle/1.json', callbackMock);

    assert.propEqual( res, mockAjax.responseText, "Wrong data" );
});

QUnit.test( "bonusCardModule.updateRowStatus", function( assert ) {

    var bonusCardModule = BonusCardModule;

    var docMock = $('<table><tr data-id="1"><td class="grid-column-status">active</td></tr></table>');
    bonusCardModule.updateRowStatus({id:1,status:'inactive'}, docMock);

    assert.equal( $('tr[data-id="1"] td.grid-column-status', docMock).html(), "inactive", "HTML update failure" );
});