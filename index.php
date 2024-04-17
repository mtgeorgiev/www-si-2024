<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Заглавие</title>
        <link href="style.css" rel="stylesheet">
        <script src="test1.js" defer></script>
    </head>
    <body>
        <a style="position: fixed; top: 10px; left: 10px;" href="#element_38">Към елемент 38</a>
        <content>
            <form id="login-form" method="post" action="./submittedForm.php?otherparam=xuz">
                <div class="row">
                    <label for="username">Потребителско име:</label>
                    <input type="text" id="username" name="username" ml="5" />
                </div>
                <div class="row">
                    <label for="password">Парола:</label>
                    <input type="password" id="password" name="password" />
                </div>
                <div class="row">
                    <input type="submit" value="Вход" id="submit-form"/>
                </div>
                <div class="row">
                    <span id="form-error"></span>
                </div>
            </form>
            <?php for($i = 1; $i < 100; $i ++): ?>
                <div class="row">
                    <span id="element_<?=$i?>"><?= $i ?></span>
                </div>
            <?php endfor ?>
        </content>
    </body>
</html>
