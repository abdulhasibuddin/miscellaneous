#Simpson's 3/8 Rule(Single Segment) ::(with Python)
import math
def func(x):
    return (0.2 + 25*x - 200*(x**2) + 675*(x**3) - 900*(x**4) + 400*(x**5))  #function goes here...

def main():
    print "Simpson's 3/8 Rule(Single Segment) ::\n"
    print "Enter Range [a,b]:\nLower limit, a = "
    a = input()
    print "Upper limit, b = "
    b = input()

    result = ((b-a)/8) * (func(a) + 3*func((2*a + b)/3) + 3*func((a + 2*b)/3) + func(b))
    print "Result = " + str(result)

if __name__ == '__main__':
    main()

raw_input()
