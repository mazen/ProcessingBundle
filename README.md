ProcessingBundle
----------------
This Bundle is for the [Processing Library](https://github.com/mazen/processing).


Installation
------------

After downloading / adding the sources with the package manager of your choice you
just need to add an additional route entry to your routes configuration to expose
the Toolbar and web ui. In production, you also should add the path to internal firewall.

    _processor:
        resource: "@ProcessingBundle/Resources/config/routes.yml"
        prefix: /_processing

also please update your assets with ```app/console assets:install web``` 

The Bundle currently exposes a ```processing.processor``` service which you can
use to spin off new background tasks.

License
-------
Copyright (c) 2012 Marcel Beerta

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.