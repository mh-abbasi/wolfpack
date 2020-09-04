<?php


namespace App\Services;
use App\Contracts\Packable;
use App\Wolf as WolfModel;
use Exception;


/**
 * Class Wolf
 * Implementing Packable interface
 * @package App\Services
 */
class Wolf implements Packable
{

    /**
     * Storing the last used wolf model to reduce number of queries
     * @var null
     */
    private $wolf = null;

    /**
     * Using WolfPack service
     * @var null
     */
    private $wolfPackHandler = null;


    /**
     * Wolf constructor.
     * @param WolfPack $wolfPackHandler
     */
    public function __construct(WolfPack $wolfPackHandler)
    {
        $this->wolfPackHandler = $wolfPackHandler;
    }

    /**
     * Store a wolf
     * @param $payload
     * @return WolfModel
     */
    public function store($payload)
    {
        return $this->wolf = WolfModel::create($payload);
    }

    /**
     * Update a wolf using payload
     *
     * @param $wolfId
     * @param $payload
     * @return WolfModel|null
     */
    public function update($wolfId, $payload)
    {
        $wolf = $this->getById($wolfId);
        $wolf->fill($payload)->save();
        return $wolf;
    }

    /**
     * Lit all the wolves stored in database
     * @return WolfModel[]|[]
     */
    public function index()
    {
        return WolfModel::all();
    }

    /**
     * Get a wolf by Its ID
     * @param $wolfId
     * @return WolfModel|null
     */
    public function getById($wolfId)
    {
        if( $this->wolf !== null && $this->wolf->id == $wolfId ) {
            return $this->wolf;
        }
        return WolfModel::findOrFail($wolfId);
    }

    /**
     * Delete a wolf
     * @param $wolfId
     * @return bool|null
     * @throws Exception
     */
    public function destroy($wolfId)
    {
        $wolf = $this->getById($wolfId);
        return $wolf->delete();
    }

    /**
     * Add a wolf to a pack
     * @param $wolfId
     * @param $packId
     * @return
     * @throws Exception
     */
    public function addToPack($wolfId, $packId)
    {
        $pack = $this->wolfPackHandler->getById($packId);
        $wolf = $this->getById($wolfId);
        if( $pack->wolves->find($wolfId) ) {
            throw new \Exception( trans("Wolf is already in the pack!"));
        }
        return $pack->wolves()->attach($wolf->id);
    }

    /**
     * Remove a wolf from a pock
     * @param $wolfId
     * @param $packId
     * @return
     * @throws Exception
     */
    public function removeFromPack($wolfId, $packId)
    {
        $pack = $this->wolfPackHandler->getById($packId);
        $wolf = $this->getById($wolfId);
        if( !$pack->wolves->find($wolfId) ) {
            throw new \Exception( trans("Wolf was not in the pack!"));
        }
        return $pack->wolves()->detach($wolf->id);
    }
}
