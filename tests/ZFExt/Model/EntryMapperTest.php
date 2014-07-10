<?php
class ZFExt_Model_EntryMapperTest extends PHPUnit_Framework_TestCase
{
    protected $_tableGateway = null;
    protected $_adapter = null;
    protected $_rowset = null;
    protected $_mapper = null;
    public function setup()
    {
        $this->_tableGateway = $this->_getCleanMock(
            'Zend_Db_Table_Abstract'
        );
        $this->_adapter = $this->_getCleanMock(
            'Zend_Db_Adapter_Abstract'
        );
        $this->_rowset = $this->_getCleanMock(
            'Zend_Db_Table_Rowset_Abstract'
        );
        $this->_tableGateway->expects($this->any())->method('getAdapter')
            ->will($this->returnValue($this->_adapter));
        $this->_mapper = new ZFExt_Model_EntryMapper($this->_tableGateway);
    }
    protected function _getCleanMock($className) {
        $class = new ReflectionClass($className);
        $methods = $class->getMethods();
        $stubMethods = array();
        foreach ($methods as $method) {
            if ($method->isPublic() || ($method->isProtected()
                    && $method->isAbstract())) {
                $stubMethods[] = $method->getName();
            }
        }
        $mocked = $this->getMock(
            $className,
            $stubMethods,
            array(),
            $className . '_EntryMapperTestMock_' . uniqid(),
            false
        );
        return $mocked;
    }

    public function testSavesNewEntryAndSetsEntryIdOnSave() {
        $author = new ZFExt_Model_Author(array(
            'id' => 2,
            'username' => 'joe_bloggs',
            'fullname' => 'Joe Bloggs',
            'email' => 'joe@example.com',
            'url' => 'http://www.example.com'
        ));
        $entry = new ZFExt_Model_Entry(array(
            'title' => 'My Title',
            'content' => 'My Content',
            'published_date' => '2009-08-17T17:30:00Z',
            'author' => $author
        ));
// set mock expectation on calling Zend_Db_Table::insert()
        $insertionData = array(
            'title' => 'My Title',
            'content' => 'My Content',
            'published_date' => '2009-08-17T17:30:00Z',
            'author_id' => 2
        );
        $this->_tableGateway->expects($this->once())
            ->method('insert')
            ->with($this->equalTo($insertionData))
            ->will($this->returnValue(123));
        $this->_mapper->save($entry);
        $this->assertEquals(123, $entry->id);
    }

    public function testFindsRecordByIdAndReturnsDomainObject()
    {
        $author = new ZFExt_Model_Author(array(
            'id' => 1,
            'username' => 'joe_bloggs',
            'fullname' => 'Joe Bloggs',
            'email' => 'joe@example.com',
            'url' => 'http://www.example.com'
        ));
        $entry = new ZFExt_Model_Entry(array(
            'id' => 1,
            'title' => 'My Title',
            'content' => 'My Content',
            'published_date' => '2009-08-17T17:30:00Z',
            'author' => $author
        ));
// expected rowset result for found entry
        $dbData = new stdClass;
        $dbData->id = 1;
        $dbData->title = 'My Title';
        $dbData->content = 'My Content';
        $dbData->published_date = '2009-08-17T17:30:00Z';
        $dbData->author_id = 1;
// set mock expectation on calling Zend_Db_Table::find()
        $this->_rowset->expects($this->once())
            ->method('current')
            ->will($this->returnValue($dbData));
        $this->_tableGateway->expects($this->once())
            ->method('find')
            ->with($this->equalTo(1))
            ->will($this->returnValue($this->_rowset));
// mock the AuthorMapper - it has separate tests
        $authorMapper = $this->_getCleanMock('ZFExt_Model_AuthorMapper');
        $authorMapper->expects($this->once())
            ->method('find')->with($this->equalTo(1))
            ->will($this->returnValue($author));
        $this->_mapper->setAuthorMapper($authorMapper);
        $entryResult = $this->_mapper->find(1);
        $this->assertEquals($entry, $entryResult);
    }
    public function testDeletesEntryUsingEntryId()
    {
        $this->_adapter->expects($this->once())
            ->method('quoteInto')
            ->with($this->equalTo('id = ?'), $this->equalTo(1))
            ->will($this->returnValue('entry_id = 1'));
        $this->_tableGateway->expects($this->once())
            ->method('delete')
            ->with($this->equalTo('id = 1'));
        $this->_mapper->delete(1);
    }
    public function testDeletesEntryUsingEntryObject()
    {
        $author = new ZFExt_Model_Author(array(
            'id' => 2,
            'username' => 'joe_bloggs',
            'fullname' => 'Joe Bloggs',
            'email' => 'joe@example.com',
            'url' => 'http://www.example.com'
        ));
        $entry = new ZFExt_Model_Entry(array(
            'id' => 1,
            'title' => 'My Title',
            'content' => 'My Content',
            'published_date' => '2009-08-17T17:30:00Z',
            'author' => $author
        ));
        $this->_adapter->expects($this->once())
            ->method('quoteInto')
            ->with($this->equalTo('id = ?'), $this->equalTo(1))
            ->will($this->returnValue('entry_id = 1'));
        $this->_tableGateway->expects($this->once())
            ->method('delete')
            ->with($this->equalTo('id = 1'));
        $this->_mapper->delete($entry);
    }
}