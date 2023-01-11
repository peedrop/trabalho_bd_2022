<?php
namespace App\Http\Controllers\Api;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CursoCollection;

class AlunoCursosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Aluno $aluno)
    {
        $this->authorize('view', $aluno);

        $search = $request->get('search', '');

        $cursos = $aluno
            ->cursos()
            ->search($search)
            ->latest()
            ->paginate();

        return new CursoCollection($cursos);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aluno $aluno, Curso $curso)
    {
        $this->authorize('update', $aluno);

        $aluno->cursos()->syncWithoutDetaching([$curso->id]);

        return response()->noContent();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Aluno $aluno
     * @param \App\Models\Curso $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Aluno $aluno, Curso $curso)
    {
        $this->authorize('update', $aluno);

        $aluno->cursos()->detach($curso);

        return response()->noContent();
    }
}
