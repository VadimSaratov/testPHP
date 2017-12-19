<?php include ROOT . '/views/layout/header.php';?>
<section>
	<div class="container">
        <?php if (isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red"> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
		<form class="form-horizontal" id="register_form" method="post" action="/register/">
			<fieldset>

				<!-- Form Name -->
				<legend>Регистрация </legend>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">ФИО:</label>
					<div class="col-md-4">
						<input id="full_name" name="full_name" type="text" placeholder="ФИО" class="form-control input-md" required >
                        <span class="d-none"></span>

					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="textinput">Email:</label>
					<div class="col-md-4">
						<input id="email" name="email" type="text" placeholder="example@mail.com" class="form-control input-md" required>
					</div>
				</div>

				<!-- Select region -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="region">Область:</label>
					<div class="col-md-4">
						<select id="region" name="region" class="form-control">
                            <option value="">--Выберите область--</option>
							<?php foreach ($regions as $region):?>
                                <option value="<?php echo $region['reg_id'];?>"><?php echo $region['ter_name'];?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>

				<!-- Select city -->
				<div class="form-group d-none">
					<label class="col-md-4 control-label" for="city">Город:</label>
					<div class="col-md-4">
						<select id="city" name="city" class="form-control">

						</select>
					</div>
				</div>

				<!-- Select district -->
				<div class="form-group d-none">
					<label class="col-md-4 control-label " for="district">Район:</label>
					<div class="col-md-4">
						<select id="district" name="district" class="form-control" data-placeholder="Choose a country...">
                            <option value="">--Выберите район--</option>
						</select>
					</div>
				</div>

                <!-- Token-->
                <div class="form-group d-none">
                    <label class="col-md-4 control-label" for="textinput">Email:</label>
                    <div class="col-md-4">
                        <input id="token" name="token" type="hidden" class="form-control input-md" value="<?php echo test\components\Token::generate_token();?>">
                    </div>
                </div>

				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="register"></label>
					<div class="col-md-4">
						<button id="register" name="register" class="btn btn-success">Регистрация</button>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</section>



<?php include ROOT . '/views/layout/footer.php';?>