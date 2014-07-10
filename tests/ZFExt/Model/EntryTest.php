<?php
require_once 'ZFExt/Model/Entry.php';
class ZFExt_Model_EntryTest extends PHPUnit_Framework_TestCase
{
// ...
    public function testAllowsAuthorIdToBeStoredAsAReference()
    {
        $entry = new ZFExt_Model_Entry;
        $entry->setReferenceId('author', 5);
        $this->assertEquals(5, $entry->getReferenceId('author'));
    }
    public function testLazyLoadingAuthorsRetrievesAuthorDomainObject()
    {
        $author = new ZFExt_Model_Author(array(
            'id' => 5,
            'username' => 'joe_bloggs',
            'fullname' => 'Joe Bloggs',
            'email' => 'joe@example.com',
            'url' => 'http://www.example.com'
        ));
        $entry = new ZFExt_Model_Entry;
        $entry->setReferenceId('author', 5);
        $authorMapper = $this->_getCleanMock('ZFExt_Model_AuthorMapper');
        $authorMapper->expects($this->once())
            ->method('find')
            ->with($this->equalTo(5))
            ->will($this->returnValue($author));
        $entry->setAuthorMapper($authorMapper);
        $this->assertEquals('Joe Bloggs', $entry->author->fullname);
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
            $className . '_EntryTestMock_' . uniqid(),
            false
        );
        return $mocked;
    }
    public function testCannotSetNewPropertiesUnlessDefinedForDomainObject()
    {
        $entry = new ZFExt_Model_Entry;
        try {
            $entry->notdefined = 1;
            $this->fail('Setting new property not defined in class should'
                . ' have raised an Exception');
        } catch (ZFExt_Model_Exception $e) {
        }
    }

    public function testThrowsExceptionIfAuthorNotAnAuthorEntityObject()
    {
        $entry = new ZFExt_Model_Entry;
        try {
            $entry->author = 1;
            $this->fail('Setting author should have raised an Exception'
                . ' since value was not an instance of ZFExt_Model_Author');
        } catch (ZFExt_Model_Exception $e) {
        }
    }
}