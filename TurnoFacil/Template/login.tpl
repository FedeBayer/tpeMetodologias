{include file="Template/head.tpl"}

<div class="container login-container">
            <div class="row">
                <div class="colorLogin col-md-6 login-form-2">
                    <h3>Login paciente</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingrese DNI" value="" />
                        </div>
                     <div class="form-group">
                            <button type="submit" class="btnSubmit" value="Login"><a href="{BASE_URL}verTurnos">login</a></button>
                        </div>

                    </form>
                </div>
                <div class="colorLogin col-md-6 login-form-2">
                    <h3>Login Secretaria</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingrese mail" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Ingrese contraseña" value="" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btnSubmit" value="Login"><a href="{BASE_URL}viewSecretaria">login</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<footer>

</footer>
<script src="js/app_turn.js"></script>
</body>

</html>