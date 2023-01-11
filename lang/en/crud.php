<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'alunos' => [
        'name' => 'Alunos',
        'index_title' => 'Lista de Alunos',
        'new_title' => 'Novo Aluno',
        'create_title' => 'Criar Aluno',
        'edit_title' => 'Editar Aluno',
        'show_title' => 'Visualizar Aluno',
        'inputs' => [
            'nome' => 'Nome',
            'email' => 'Email',
            'data_nascimento' => 'Data Nascimento',
            'cpf' => 'Cpf',
        ],
    ],

    'cursos' => [
        'name' => 'Cursos',
        'index_title' => 'Lista de Cursos',
        'new_title' => 'Novo Curso',
        'create_title' => 'Criar Curso',
        'edit_title' => 'Editar Curso',
        'show_title' => 'Visualizar Curso',
        'inputs' => [
            'faculdade_id' => 'Faculdade',
            'nome' => 'Nome',
        ],
    ],

    'departamentos' => [
        'name' => 'Departamentos',
        'index_title' => 'Lista de Departamentos',
        'new_title' => 'Novo Departamento',
        'create_title' => 'Criar Departamento',
        'edit_title' => 'Editar Departamento',
        'show_title' => 'Visualizar Departamento',
        'inputs' => [
            'nome' => 'Nome',
            'area' => 'Area',
        ],
    ],

    'disciplinas' => [
        'name' => 'Disciplinas',
        'index_title' => 'Lista de Disciplinas',
        'new_title' => 'Nova Disciplina',
        'create_title' => 'Criar Disciplina',
        'edit_title' => 'Editar Disciplina',
        'show_title' => 'Visualizar Disciplina',
        'inputs' => [
            'curso_id' => 'Curso',
            'departamento_id' => 'Departamento',
            'nome' => 'Nome',
            'codigo' => 'Codigo',
        ],
    ],

    'equipamentos' => [
        'name' => 'Equipamentos',
        'index_title' => 'Lista de Equipamentos',
        'new_title' => 'Novo Equipamento',
        'create_title' => 'Criar Equipamento',
        'edit_title' => 'Editar Equipamento',
        'show_title' => 'Visualizar Equipamento',
        'inputs' => [
            'nome' => 'Nome',
            'sala_id' => 'Sala',
            'num_serie' => 'Num Serie',
        ],
    ],

    'faculdades' => [
        'name' => 'Faculdades',
        'index_title' => 'Lista de Faculdades',
        'new_title' => 'Nova Faculdade',
        'create_title' => 'Criar Faculdade',
        'edit_title' => 'Editar Faculdade',
        'show_title' => 'Visualizar Faculdade',
        'inputs' => [
            'nome' => 'Nome',
            'endereco' => 'Endereco',
        ],
    ],

    'professores' => [
        'name' => 'Professores',
        'index_title' => 'Lista de Professores',
        'new_title' => 'Novo Professor',
        'create_title' => 'Criar Professor',
        'edit_title' => 'Editar Professor',
        'show_title' => 'Visualizar Professor',
        'inputs' => [
            'departamento_id' => 'Departamento',
            'name' => 'Name',
        ],
    ],

    'reservas' => [
        'name' => 'Reservas',
        'index_title' => 'Lista de Reservas',
        'new_title' => 'Nova Reserva',
        'create_title' => 'Criar Reserva',
        'edit_title' => 'Editar Reserva',
        'show_title' => 'Visualizar Reserva',
        'inputs' => [
            'data' => 'Data',
            'sala_id' => 'Sala',
        ],
    ],

    'salas' => [
        'name' => 'Salas',
        'index_title' => 'Lista de Salas',
        'new_title' => 'Nova Sala',
        'create_title' => 'Criar Sala',
        'edit_title' => 'Editar Sala',
        'show_title' => 'Visualizar Sala',
        'inputs' => [
            'numero' => 'Numero',
        ],
    ],

    'turmas' => [
        'name' => 'Turmas',
        'index_title' => 'Lista de Turmas',
        'new_title' => 'Nova Turma',
        'create_title' => 'Criar Turma',
        'edit_title' => 'Editar Turma',
        'show_title' => 'Visualizar Turma',
        'inputs' => [
            'disciplina_id' => 'Disciplina',
            'professor_id' => 'Professor',
            'codigo' => 'Codigo',
        ],
    ],

    'usu_rios' => [
        'name' => 'Usuários',
        'index_title' => 'Lista de Usuários',
        'new_title' => 'Novo Usuário',
        'create_title' => 'Criar Usuário',
        'edit_title' => 'Editar Usuário',
        'show_title' => 'Visualizar Usuário',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],
];
