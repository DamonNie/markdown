#欢迎使用 Markdown在线编辑器 MdEditor
**Markdown是一种轻量级的「标记语言」**
![markdown](https://www.mdeditor.com/images/logos/markdown.png "markdown")
Markdown是一种可以使用普通文本编辑器编写的标记语言，通过简单的标记语法，它可以使普通文本内容具有一定的格式。它允许人们使用易读易写的纯文本格式编写文档，然后转换成格式丰富的HTML页面，Markdown文件的后缀名便是“.md”
##MdEditor是一个在线编辑Markdown文档的编辑器
*MdEditor扩展了Markdown的功能（如表格、脚注、内嵌HTML等等），以使让Markdown转换成更多的格式，和更丰富的展示效果，这些功能原初的Markdown尚不具备。*
>Markdown增强版中比较有名的有Markdown Extra、MultiMarkdown、 Maruku等。这些衍生版本要么基于工具，如
~~Pandoc~~
                ，Pandao；要么基于网站，如GitHub和Wikipedia，在语法上基本兼容，但在一些语法和渲染效果上有改动。
MdEditor源于Pandao的JavaScript开源项目，开源地址[Editor.md](https://github.com/pandao/editor.md "title="Editor.md"")，并在MIT开源协议的许可范围内进行了优化，以适应广大用户群体的需求。向优秀的markdown开源编辑器原作者Pandao致敬。
![Pandao editor.md](https://pandao.github.io/editor.md/images/logos/editormd-logo-180x180.png "Pandao editor.md")
##MdEditor的功能列表演示
#标题H1
##标题H2
###标题H3####标题H4#####标题H5######标题H5
###字符效果和横线等
---
~~删除线~~
~~删除线（开启识别HTML标签时）~~
*斜体字* *斜体字*
**粗体** **粗体**
***粗斜体*** ***粗斜体***
上标：X<sub>2</sub>，下标：O<sup>2</sup>
**缩写(同HTML的abbr标签)**
>即更长的单词或短语的缩写形式，前提是开启识别HTML标签时，已默认开启
The[HTML</abbr> specification is maintained by the <abbr
                title="World Wide Web Consortium">W3C</abbr>.
### <a name="引用 Blockquotes" class="reference-link">]( "bbr title="Hyper Text Markup Language"")引用 Blockquotes
>引用文本 Blockquotes
引用的行内混合 Blockquotes
>引用：如果想要插入空白换行`即<br />标签`，在插入处先键入两个以上的空格然后回车即可，[普通链接](https://www.mdeditor.com/ "")。
###锚点与链接 Links
[普通链接](https://www.mdeditor.com/ "")
[普通链接带标题](https://www.mdeditor.com/ "title="普通链接带标题"")
直接链接：[https://www.mdeditor.com](https://www.mdeditor.com "")
[锚点链接](https://www.mdeditor.com/ "")
[mailto:test.test@gmail.com](mailto:test.test@gmail.com "")
GFM a-tail link[@pandao](https://github.com/pandao "title="@pandao"")
邮箱地址自动链接[test.test@gmail.com](mailto:test.test@gmail.com "")[www@vip.qq.com](mailto:www@vip.qq.com "")
>[@pandao](https://github.com/pandao "title="@pandao"")
###多语言代码高亮 Codes####行内代码 Inline code
执行命令：`npm install marked`
####缩进风格
即缩进四个空格，也做为实现类似`<pre>` 预格式化文本 ( Preformatted Text ) 的功能。
```html

    echo "Hello world!";
?>
```
预格式化文本：
```html
| First Header  | Second Header |
| ------------- | ------------- |
| Content Cell  | Content Cell  |
| Content Cell  | Content Cell  |
```
####JS代码
```html
function test() {
    console.log("Hello world!");
}
```
####HTML 代码 HTML codes
```html


    
        
        
        Hello world!
        
            body{font-size:14px;color:#444;font-family: "Microsoft Yahei", Tahoma, "Hiragino Sans GB", Arial;background:#fff;}
            ul{list-style: none;}
            img{border:none;vertical-align: middle;}
        
    
    
        Hello world!
        Plain text
    

```
###图片 Images
图片加链接 (Image + Link)：
[![](https://www.mdeditor.com/images/logos/markdown.png "")](https://www.mdeditor.com/images/logos/markdown.png "title="markdown"")[>Follow your heart.
    ---](https://www.mdeditor.com/images/logos/markdown.png "title="markdown"")
###[](https://www.mdeditor.com/images/logos/markdown.png "title="markdown"")列表
            Lists####无序列表（减号）Unordered Lists (-)
        
* 列表一
* 列表二
* 列表三

####无序列表（星号）Unordered Lists (*)
        
* 列表一
* 列表二
* 列表三

####无序列表（加号和嵌套）Unordered Lists (+)
        
* 列表一
* 列表二
                <ul>
                    <li>列表二-1
* 列表二-2
* 列表二-3

            </li>
            <li>列表三
                
* 列表一
* 列表二
* 列表三

            </li>
        </ul>
####有序列表 Ordered Lists (-)

1.  第一行
2.  第二行
3.  第三行
        
####GFM task list
        
* GFM task list 1
* GFM task list 2
* GFM task list 3
                <ul>
                    <li style="list-style: none;"> GFM task list
                        3-1
* GFM task list
                        3-2
* GFM task list
                        3-3

            </li>
            <li style="list-style: none;"> GFM task list 4
                
* GFM task list
                        4-1
* GFM task list
                        4-2

            </li>
        </ul>
---
###绘制表格 Tables
        
|项目|价格|数量|
|-|-|-|
|计算机|$1600|5|
|手机|$12|12|
|管线|$1|234|
        
|First Header|Second Header|
|-|-|
|Content Cell|Content Cell|
|Content Cell|Content Cell|
        
|First Header|Second Header|
|-|-|
|Content Cell|Content Cell|
|Content Cell|Content Cell|
        
|Function name|Description|
|-|-|
|`help()`|Display the help window.|
|`destroy()`|**Destroy your computer!**|
        
|Left-Aligned|Center Aligned|Right Aligned|
|-|-|-|
|col 3 is|some wordy text|$1600|
|col 2 is|centered|$12|
|zebra stripes|are neat|$1|
        
|Item|Value|
|-|-|
|Computer|$1600|
|Phone|$12|
|Pipe|$1|
---
####特殊符号 HTML Entities Codes
© & ¨ ™ ¡ £
& < > ¥ € ® ± ¶ § ¦ ¯ « ·
X² Y³ ¾ ¼ × ÷ »
18ºC " "
---
###Emoji表情![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "")
>Blockquotes![:star:](http://www.emoji-cheat-sheet.com/graphics/emojis/star.png "")
####GFM task lists &
            Emoji & fontAwesome icon emoji & editormd logo emoji
        
*![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "")[@mentions](https://github.com/mentions "title="@mentions""),![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "") #refs,[links]( ""),**formatting**, and
~~tags~~
                supported;
* list syntax required (any unordered or ordered list supported);
* [ ]![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "") this is a complete item![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "");
* []this is an
                incomplete item[test link](# "")[@pandao](https://github.com/pandao "title="@pandao"");
* [ ]this is an
                incomplete item;
                <ul>
                    <li style="list-style: none;">![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "") this is an incomplete item[test link](# "");
*![:smiley:](http://www.emoji-cheat-sheet.com/graphics/emojis/smiley.png "") this is an incomplete item[test link](# "");

            </li>
        </ul>
####反斜杠 Escape
*literal asterisks*
---
### 科学公式 TeX(KaTeX)
行内的公式<math><semantics><mrow><mi>E</mi><mo>=</mo><mi>m</mi><msup><mi>c</mi><mn>2</mn></msup></mrow>[E=mc^2</annotation></semantics></math>E=mc​2​​行内的公式，行内的<math><semantics><mrow><mi>E</mi><mo>=</mo><mi>m</mi><msup><mi>c</mi><mn>2</mn></msup></mrow><annotation
                encoding="application/x-tex">E=mc^2</annotation></semantics></math>E=mc​2​​公式。
<math><semantics><mrow><mi>x</mi><mo>></mo><mi>y</mi></mrow><annotation
                encoding="application/x-tex">x > y</annotation></semantics></math>x>y
<math><semantics><mrow><mo>(</mo><msqrt><mrow><mn>3</mn><mi>x</mi><mo>−</mo><mn>1</mn></mrow></msqrt><mo>+</mo><mo>(</mo><mn>1</mn><mo>+</mo><mi>x</mi><msup><mo>)</mo><mn>2</mn></msup><mo>)</mo></mrow><annotation
                encoding="application/x-tex">(\sqrt{3x-1}+(1+x)^2)</annotation></semantics></math>(√​3x−1​​​+(1+x)​2​​)
<math><semantics><mrow><mi>sin</mi><mo>(</mo><mi>α</mi><msup><mo>)</mo><mrow><mi>θ</mi></mrow></msup><mo>=</mo><msubsup><mo>∑</mo><mrow><mi>i</mi><mo>=</mo><mn>0</mn></mrow><mrow><mi>n</mi></mrow></msubsup><mo>(</mo><msup><mi>x</mi><mi>i</mi></msup><mo>+</mo><mi>cos</mi><mo>(</mo><mi>f</mi><mo>)</mo><mo>)</mo></mrow><annotation
                encoding="application/x-tex">\sin(\alpha)^{\theta}=\sum_{i=0}^{n}(x^i + \cos(f))</annotation></semantics></math>sin(α)​θ​​=∑​i=0​n​​(x​i​​+cos(f))
多行公式：

---
### <a name="绘制流程图 Flowchart" class="reference-link">]( "")绘制流程图 Flowchart
<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

                    <marker id="raphael-marker-endblock33-obj8" markerHeight="3" markerWidth="3" orient="auto"
                            refX="1.5" refY="1.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 1.5 1.5) scale(0.6,0.6)"
                             stroke-width="1.6667" fill="black" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                    <marker id="raphael-marker-endblock33-obj9" markerHeight="3" markerWidth="3" orient="auto"
                            refX="1.5" refY="1.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 1.5 1.5) scale(0.6,0.6)"
                             stroke-width="1.6667" fill="black" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                    <marker id="raphael-marker-endblock33-obj10" markerHeight="3" markerWidth="3" orient="auto"
                            refX="1.5" refY="1.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 1.5 1.5) scale(0.6,0.6)"
                             stroke-width="1.6667" fill="black" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                    <marker id="raphael-marker-endblock33-obj12" markerHeight="3" markerWidth="3" orient="auto"
                            refX="1.5" refY="1.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 1.5 1.5) scale(0.6,0.6)"
                             stroke-width="1.6667" fill="black" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                </defs>
                <rect x="0" y="0" width="81" height="38" rx="20" ry="20" fill="#ffffff" stroke="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" stroke-width="2" class="flowchart" id="st"
                      transform="matrix(1,0,0,1,99.7891,53.1445)"></rect>
                <text x="10" y="19" text-anchor="start" font-family=""Arial"" font-size="14px" stroke="none"
                      fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;"
                      id="stt" class="flowchartt" transform="matrix(1,0,0,1,99.7891,53.1445)">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">用户登陆</tspan>
                </text>
                <rect x="0" y="0" width="82" height="38" rx="0" ry="0" fill="#ffffff" stroke="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" stroke-width="2" class="flowchart" id="op"
                      transform="matrix(1,0,0,1,99.2891,194.2891)"></rect>
                <text x="10" y="19" text-anchor="start" font-family=""Arial"" font-size="14px" stroke="none"
                      fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;"
                      id="opt" class="flowchartt" transform="matrix(1,0,0,1,99.2891,194.2891)">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">登陆操作</tspan>
                </text>

                <text x="73.14453125" y="68.14453125" text-anchor="start" font-family=""Arial""
                      font-size="14px" stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;"
                      id="condt" class="flowchartt" transform="matrix(1,0,0,1,4,286.2891)">
                    <tspan dy="4.99609375" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">登陆成功 Yes or No?
                    </tspan>
                </text>
                <rect x="0" y="0" width="82" height="38" rx="20" ry="20" fill="#ffffff" stroke="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);" stroke-width="2" class="end-element" id="e"
                      transform="matrix(1,0,0,1,99.2891,525.7227)"></rect>
                <text x="10" y="19" text-anchor="start" font-family=""Arial"" font-size="14px" stroke="none"
                      fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;"
                      id="et" class="end-elementt" transform="matrix(1,0,0,1,99.2891,525.7227)">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">进入后台</tspan>
                    <tspan dy="18" x="10" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></tspan>
                </text>



                <text x="145.2890625" y="432.578125" text-anchor="start" font-family=""Arial""
                      font-size="14px" stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">yes</tspan>
                </text>

                <text x="281.578125" y="344.43359375" text-anchor="start" font-family=""Arial""
                      font-size="14px" stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: start; font-family: Arial; font-size: 14px;">
                    <tspan dy="5.00390625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">no</tspan>
                </text>
---
###绘制序列图 Sequence Diagram
<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc>
                <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                    <marker id="raphael-marker-endblock55-obj36" markerHeight="5" markerWidth="5" orient="auto"
                            refX="2.5" refY="2.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 2.5 2.5) scale(1,1)"
                             stroke-width="1.0000" fill="#000" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                    <marker id="raphael-marker-endblock55-obj42" markerHeight="5" markerWidth="5" orient="auto"
                            refX="2.5" refY="2.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-block" transform="rotate(180 2.5 2.5) scale(1,1)"
                             stroke-width="1.0000" fill="#000" stroke="none"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>

                    <marker id="raphael-marker-endopen77-obj45" markerHeight="7" markerWidth="7" orient="auto" refX="4"
                            refY="3.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <use xlink:href="#raphael-marker-open" transform="rotate(180 3.5 3.5) scale(1,1)"
                             stroke-width="1.0000" fill="none" stroke="#000"
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></use>
                    </marker>
                </defs>
                <rect x="10" y="20" width="71.25" height="38" rx="0" ry="0" fill="none" stroke="#000000"
                      stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <rect x="19.875" y="30" width="51.25" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="45.625" y="39" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Andrew</tspan>
                </text>
                <rect x="10" y="258" width="71.25" height="38" rx="0" ry="0" fill="none" stroke="#000000"
                      stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <rect x="19.875" y="268" width="51.25" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="45.625" y="277" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Andrew</tspan>
                </text>

                <rect x="175.21875" y="20" width="61.25" height="38" rx="0" ry="0" fill="none" stroke="#000000"
                      stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <rect x="185.21875" y="30" width="41.25" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="205.84375" y="39" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">China</tspan>
                </text>
                <rect x="175.21875" y="258" width="61.25" height="38" rx="0" ry="0" fill="none" stroke="#000000"
                      stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <rect x="185.21875" y="268" width="41.25" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="205.84375" y="277" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">China</tspan>
                </text>

                <rect x="84.484375" y="74" width="82.5" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="125.734375" y="83" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Says Hello</tspan>
                </text>

                <rect x="225.84375" y="116" width="108.96875" height="46" rx="0" ry="0" fill="none" stroke="#000000"
                      stroke-width="2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <rect x="230.84375" y="121" width="98.96875" height="36" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="280.328125" y="139" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="-4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">China thinks</tspan>
                    <tspan dy="18" x="280.328125" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">about it
                    </tspan>
                </text>
                <rect x="76.25" y="178" width="98.96875" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="125.734375" y="187" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">How are you?</tspan>
                </text>

                <rect x="55.625" y="216" width="140.21875" height="18" rx="0" ry="0" fill="#ffffff" stroke="none"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                <text x="125.734375" y="225" text-anchor="middle" font-family="Andale Mono, monospace" font-size="16px"
                      stroke="none" fill="#000000"
                      style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: "Andale Mono", monospace; font-size: 16px;">
                    <tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">I am good thanks!</tspan>
                </text>

###End