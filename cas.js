var casper = require('casper').create();
var word = casper.cli.args[0];

if (casper.cli.args.length === 0) {
    casper.echo("No arg nor option passed").exit();
}

casper.userAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53');

casper.start('http://www.google.co.jp/images?q=' + word,function(){
    this.capture("test.png");
    this.echo(this.getHTML());
});

casper.run();
