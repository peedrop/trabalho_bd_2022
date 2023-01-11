<?php
namespace App\Http\Controllers\Api;

use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlunoCollection;

class CursoAlunosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Curso $curso)
    {
        $this->authorize('view', $curso);

        $search = $request->get('search', '');

        $alunos = $curso
            ->alunos()
            ->search($search)
            ->latest()
            ->paginate();

        return new AlunoCollection($alunos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Curso $curso, Aluno $aluno)
    {
        $this->authorize('update', $curso);

        $curso->alunos()->syncWithoutDetaching([$aluno->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Curso $curso
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Curso $curso, Aluno $aluno)
    {
        $this->authorize('update', $curso);

        $curso->alunos()->detach($aluno);

        return response()->noContent();
    }
}
