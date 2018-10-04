#Simpson's 1-3rd Rule(Single Segment) ::(with Python)
import math
def func(x):
    return (5*x*(math.exp(-2*x))) #function goes here...

def main():
    print "Simpson's 1-3rd Rule(Single Segment) ::\n"
    print "Enter Range [a,b]:\nLower limit, a = "
    a = input()
    print "Upper limit, b = "
    b = input()

    result = ((b-a)/6)*(func(a) + 4*func((a+b)/2) + func(b))
    print result

if __name__ == '__main__':
    main()

raw_input()
