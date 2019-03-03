pragma solidity ^ 0.5.1;
contract SafeMath {
    function safeMul(uint a, uint b) internal returns(uint) {
        uint c = a * b;
        assert(a == 0 || c / a == b);
        return c;
    }

    function safeDiv(uint a, uint b) internal returns(uint) {
        assert(b > 0);
        uint c = a / b;
        assert(a == b * c + a % b);
        return c;
    }

    function safeSub(uint a, uint b) internal returns(uint) {
        assert(b <= a);
        return a - b;
    }

    function safeAdd(uint a, uint b) internal returns(uint) {
        uint c = a + b;
        assert(c >= a && c >= b);
        return c;
    }

    function max64(uint64 a, uint64 b) internal view returns(uint64) {
        return a >= b ? a : b;
    }

    function min64(uint64 a, uint64 b) internal view returns(uint64) {
        return a < b ? a : b;
    }

    function max256(uint256 a, uint256 b) internal view returns(uint256) {
        return a >= b ? a : b;
    }

    function min256(uint256 a, uint256 b) internal view returns(uint256) {
        return a < b ? a : b;
    }

    function assert(bool assertion) internal {
        if (!assertion) {
            revert();
        }
    }
}

contract ERC20 {
    uint public totalSupply;

    function balanceOf(address who)public view returns(uint);

    function allowance(address owner, address spender)public view returns(uint);

    function transferFrom(address from, address to, uint value) public returns(bool ok);

    function approve(address spender, uint value) public returns(bool ok);

    function transfer(address to, uint value) public returns(bool ok);
    event Transfer(address indexed from, address indexed to, uint value);
    event Approval(address indexed owner, address indexed spender, uint value);
}

contract StandardToken is ERC20, SafeMath {
    mapping(address => uint) balances;
    mapping(address => mapping(address => uint)) allowed;

    function transfer(address _to, uint _value) public returns(bool success) {
        balances[msg.sender] = safeSub(balances[msg.sender], _value);
        balances[_to] = safeAdd(balances[_to], _value);
        //Transfer(msg.sender, _to, _value);
        return true;
    }

    function transferFrom(address _from, address _to, uint _value) public returns(bool success) {
        uint256 _allowance = allowed[_from][msg.sender];
        // Check is not needed because safeSub(_allowance, _value) will already throw if this condition is not met
        // if (_value > _allowance) throw;
        balances[_to] = safeAdd(balances[_to], _value);
        balances[_from] = safeSub(balances[_from], _value);
        allowed[_from][msg.sender] = safeSub(_allowance, _value);
        //Transfer(_from, _to, _value);
        return true;
    }

    function balanceOf(address _owner) public view returns(uint balance) {
        return balances[_owner];
    }

    function approve(address _spender, uint _value) public returns(bool success) {
        allowed[msg.sender][_spender] = _value;
        //Approval(msg.sender, _spender, _value);
        return true;
    }

    function allowance(address _owner, address _spender) public view returns(uint remaining) {
        return allowed[_owner][_spender];
    }
}

contract Ownable {
    address public owner;

    constructor() public {
        owner = msg.sender;
    }
    modifier onlyOwner() {
        if (msg.sender != owner) {
            revert();
        }
        _;
    }

    function transferOwnership(address newOwner) public onlyOwner {
        if (newOwner != address(0)) {
            owner = newOwner;
        }
    }
}

contract TrackFund is Ownable, StandardToken {
    event Deposit(address partyA, address partyB, uint amount, string time);
    event Withdraw(address partyA, address partyB, uint amount, string time);

    struct NGODetails{
        string country; 
        string instituteName;
        address KYCby;
        bool KYCverified;
    }
    
    struct IODetails{
        string country; 
        string instituteName;
        address KYCby;
        bool KYCverified;
    }
    
    //mapping institute detais to NGPID
    mapping(address=>NGODetails)NGODetail;
    mapping(address=>IODetails)IODetail;
    //mapping (uint => mapping (uint => escrowDetails)) escrowDetail;

    modifier onlyApprovedInstitute(address Id){
        if (NGODetail[Id].KYCverified==false && IODetail[Id].KYCverified==false)
            revert();
        _;
    }

    modifier onlyOwner(){
        if (msg.sender!=owner)
            revert();
        _;
    }
    
    function approveInstitute(string memory country, string memory instituteName, address NGOId) public onlyOwner(){
        NGODetail[NGOId].country=country;
        NGODetail[NGOId].instituteName=instituteName;
        NGODetail[NGOId].KYCverified=true;
        NGODetail[NGOId].KYCby=msg.sender;
    }
    
     function approveIO(string memory country, string memory instituteName, address IOId) public onlyOwner(){
        IODetail[IOId].country=country;
        IODetail[IOId].instituteName=instituteName;
        IODetail[IOId].KYCverified=true;
        IODetail[IOId].KYCby=msg.sender;
    }

    function transferFunds(address beneficiary, uint amount) public onlyApprovedInstitute(msg.sender){
        transfer( beneficiary, amount);
    }
    
    //to check escrow Detail
    function checkNGODetail(address NGOId) public view returns(string memory, string memory, address, bool) {
        require(msg.sender==NGOId || msg.sender==NGODetail[NGOId].KYCby);
        return (NGODetail[NGOId].country, NGODetail[NGOId].instituteName, NGODetail[NGOId].KYCby, NGODetail[NGOId].KYCverified);
    }

    function checkIODetail(address IOId)public view returns(string memory, string memory, address, bool) {
        require(msg.sender==IOId || msg.sender==IODetail[IOId].KYCby);
        return (IODetail[IOId].country, IODetail[IOId].instituteName, IODetail[IOId].KYCby, IODetail[IOId].KYCverified);
    }
}

contract Coin is TrackFund {
    string public name = "YAK coins"; // name of the token
    string public symbol = "YAK"; // ERC20 compliant 4 digit token code
    uint public decimals = 18; // token has 18 digit precision
    uint public totalSupply = 1000000000000000; // total supply of 100+6 Million Tokens
    /// @notice Initializes the contract and allocates all initial tokens to the owner
    constructor() public {
        balances[msg.sender] = totalSupply;
    }
    //////////////// owner only functions below
    /// @notice To transfer token contract ownership
    /// @param _newOwner The address of the new owner of this contract
    function transferOwnership(address _newOwner) public onlyOwner {
        balances[_newOwner] = balances[owner];
        balances[owner] = 0;
        Ownable.transferOwnership(_newOwner);
    }
}