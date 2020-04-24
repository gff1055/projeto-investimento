<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use App\Entities\Institution;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var ProductValidator
     */
    protected $validator;

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $repository
     * @param ProductValidator $validator
     */
    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    
    public function index($institution_id){     // Metodo que retorna todos os produtos da instituicao
        //$products = $this->repository->all();   // Recebe todos os produtos
        $institution = Institution::find($institution_id);  // Retorna o id da instituicao
                
        return view('institutions.product.index', [
            'institution' => $institution       // Retorna os dados da instituicao para a view INDEX

        ]);
    }

    public function store(Request $request, $institution_id){
        try {
            $data = $request->all();            // Recebe os dados do produto a ser cadastrado
            $data['institution_id'] = $institution_id;  // Recebe o id da instituicao associado
            

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);   // valida os dados
            $product = $this->repository->create($data);    // registra os dados do produto

            session()->flash('success', [
                'success' => true,
                'messages' => "produto cadastrado"
            ]);

            return redirect()->route('institution.product.index', $institution_id); // Redireciona o usuario para index de products
        }

        catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

    }

    public function show($id){
        $product = $this->repository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $product,
            ]);
        }

        return view('products.show', compact('product'));
    }

    public function edit($id){
        $product = $this->repository->find($id);
        return view('products.edit', compact('product'));
    }

    public function update(ProductUpdateRequest $request, $id){
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $product = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Product updated.',
                'data'    => $product->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        }
        
        catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }

    }


    public function destroy($institution_id, $product_id){
        $deleted = $this->repository->delete($product_id);  // Deleta o produto

        session()->flash('success', [           // Envia dados para a view
            'success' => true,
            'messages' => "Produto removido"
        ]);

        return redirect()->back();              // Retorna o usuario
    }
}
