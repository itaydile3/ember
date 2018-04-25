<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ember.js • TodoMVC</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<script type="text/x-handlebars" data-template-name="todos/index">
		<ul id="todo-list">
			{{#each todo in model itemController="todo"}}
			<li {{bind-attr class="todo.isCompleted:completed todo.isEditing:editing"}}>
				{{#if todo.isEditing}}
				{{edit-todo class="edit" value=todo.title focus-out="acceptChanges" insert-newline="acceptChanges"}}
				{{else}}
				{{input type="checkbox" checked=todo.isCompleted class="toggle"}}
				<label {{action "editTodo" on="doubleClick"}}>{{todo.title}}</label><button {{action "removeTodo"}} class="destroy"></button>
				{{/if}}
			</li>
			{{/each}}
		</ul>
	</script>
	<script type="text/x-handlebars" data-template-name="todos">
		<section id="todoapp">
			<header id="header">
				<h1>משימות</h1>
				{{input type="text" id="new-todo" placeholder="מה צריך להיעשות?"
				value=newTitle action="createTodo"}}
			</header>
			<section id="main">
				{{outlet}}
				{{input type="checkbox" id="toggle-all" checked=allAreDone}}
			</section>
			<footer id="footer">
					<ul id="filters">
						<li>
							{{#link-to "todos.active" activeClass="selected"}}לסיום:{{/link-to}}
							<strong>{{remaining}}</strong>
						</li>
						<li>
							{{#link-to "todos.completed" activeClass="selected" }} הושלמו:{{/link-to}}
							<strong>{{completed}}</strong>
						</li>
						<li>
							{{#link-to "todos.index" activeClass="selected"}}סה"כ{{/link-to}}
							<strong>{{all}}</strong>
						</li>
					</ul>
				</footer>
			</section>
			<footer id="info">
				<p>לחיצה כפולה על מנת לערוך משימה</p>
			</footer>
		</script>	
		<script src="assets/bower/jquery/dist/jquery.min.js"></script>
		<script src="assets/bower/handlebars/handlebars.min.js"></script>
		<script src="assets/bower/ember/ember.min.js"></script>
		<script src="assets/bower/ember-data/ember-data.min.js"></script>
		<script src="assets/js/application.js"></script>
		<script src="assets/js/router.js"></script>
		<script src="assets/js/models/todo.js"></script>
		<script src="assets/js/controllers/todos_controller.js"></script>
		<script src="assets/js/controllers/todo_controller.js"></script>
		<script src="assets/js/views/edit_todo_view.js"></script>
	</body>
	</html>